<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\PurchasesReturn;
use App\Models\PurchasesReturnItem;
use App\Models\ProductVariant;
use App\Models\Supplier;
use App\Services\ProductHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasesReturnController extends Controller
{
    protected $productHistoryService;

    public function __construct(ProductHistoryService $productHistoryService)
    {
        $this->productHistoryService = $productHistoryService;
    }

    public function create()
    {
        $suppliers = Supplier::where('status',1)->get();
        $lastRecord = PurchasesReturn::orderBy('id', 'desc')->first();
        $invoice_no = 1;
        if ($lastRecord) {
            $invoice_no = $lastRecord->id + 1;
        }

        return view('purchase-return.create', compact('suppliers','invoice_no'));
    }

    public function store(Request $request)
    {
        $invoice = PurchasesReturn::create([
            'supplier_id' => $request->supplier_id,
            'invoice_no' => $request->invoice_no,
            'invoice_date' => $request->invoice_date,
            'total_amount' => $request->balance,
            'paid_amount' => $request->balance,
            'notes' => $request->particulars,
            'created_by' => auth()->id()
        ]);

        foreach ($request['variant_ids'] as $key => $product_id) {

            $product_variant = ProductVariant::find($request['variant_ids'][$key]);
            if ($product_variant) {
                $old_qty = $product_variant->quantity;
                $old_expiry_date = $product_variant->expiry_date;
//                $product_variant->quantity -= $request['new_stocks'][$key];
                $product_variant->decrement('quantity', $request['new_stocks'][$key]);
                $product_variant->save();
            }

            $purchases_items = PurchasesReturnItem::create([
                'purchases_return_id' => $invoice->id,
                'product_variant_id' => $request['variant_ids'][$key],
                'quantity' => $request['new_stocks'][$key],
                'purchase_price' => $request['purchase_prices'][$key],
                'unit_price' => $request['sale_prices'][$key],
                'sale_price' => $request['sale_prices'][$key],
                'expiry_date' => $request['expiry_dates'][$key],
                'item_total' => $request['item_total'][$key],
                'old_qty' => $old_qty,
                'old_expiry_date' => $old_expiry_date,
            ]);

            $this->productHistoryService->createProductHistory(
                $request['variant_ids'][$key],
                null,
                $request['new_stocks'][$key],
                'Stock Return',
                'Product Stock Return Invoice# '. $invoice->id,
                auth()->id(),
                1,
                'PURCHASES_RETURN'
            );
        }

        return redirect()->route('purchases-returns.index')->with('success', 'Product Purchases Return is successfully add!');
    }

    public function edit($id)
    {
        $suppliers = Supplier::where('status', 1)->get();

        $purchase = PurchasesReturn::with(['purchaseReturnItems' => function ($query) {
            $query->where('status', 1)->with('productVariant.product');
        }])->findOrFail($id);

        return view('purchase-return.edit', compact('purchase', 'suppliers'));
    }

    public function update(Request $request)
    {
        //Update Purchases return Invoices
        $purchase = PurchasesReturn::findOrFail($request->purchase_id);
        if($request->balance>0){
            $total_bill = $purchase->total_amount + $request->balance;
            $purchase->update([
                'supplier_id' => $request->supplier_id,
                'invoice_no' => $request->invoice_no,
                'invoice_date' => $request->invoice_date,
                'total_amount' => $total_bill,
                'paid_amount' => $total_bill,
                'notes' => $request->particulars,
                'created_by' => auth()->id()
            ]);
        }

        // Loop through the new purchase return items
        foreach ($request['product_ids'] as $key => $product_id) {

            //Add new Purchases Return Items
            if($request['purchase_item_ids'][$key]=='1')
            {
                $product_variant = ProductVariant::find($request['variant_ids'][$key]);
                if ($product_variant) {
                    $old_qty = $product_variant->quantity - $request['new_stocks'][$key];
                    $old_expiry_date = $product_variant->expiry_date;
                    $product_variant->quantity -= $request['new_stocks'][$key];
//                    $product_variant->expiry_date = $request['expiry_dates'][$key];
                    $product_variant->save();
                }

                $purchases_items = PurchasesReturnItem::create([
                    'purchases_return_id' => $purchase->id,
                    'product_variant_id' => $request['variant_ids'][$key],
                    'quantity' => $request['new_stocks'][$key],
                    'purchase_price' => $request['purchase_prices'][$key],
                    'unit_price' => $request['sale_prices'][$key],
                    'sale_price' => $request['sale_prices'][$key],
                    'expiry_date' => $request['expiry_dates'][$key],
                    'item_total' => $request['item_total'][$key],
                    'old_qty' => $old_qty,
                    'old_expiry_date' => $old_expiry_date,
                ]);
            }

            //If item is removed from list
            if(isset($request['delete_items'][$key]))
            {
                $purchases_item = PurchasesReturnItem::find($request['delete_items'][$key]);
                if ($purchases_item) {
                    $purchases_item->status = 0;
                    $purchases_item->save();
                }
                //update product variant by adding ack in stock
                $product_variant1 = ProductVariant::find($purchases_item->variant_ids);
                if ($product_variant1) {
                    $new_stock = $product_variant1->quantity + $purchases_item->quantity;;
                    $product_variant1->quantity = $new_stock; // Add new stock to existing quantity
                    $product_variant1->save();
                    dd($product_variant1);
                }

                $total_bill = (float)$purchase->total_amount - (float)$request['item_total'][$key];
                $purchase->update([
                    'total_amount' => $total_bill,
                    'paid_amount' => $total_bill,
                ]);
            }
        }
        return redirect()->route('purchases-returns.index')->with('success', 'Product Purchases Return is successfully Updated!');
//        return redirect()->route('purchases-returns')->with('success', 'Product purchases is successfully add!');
    }

//    public function store(Request $request)
//    {
//        $validatedData = $request->validate([
//            'supplier_id' => 'required|exists:suppliers,id',
//            'created_by' => 'required|exists:users,id',
////            'purchase_date' => 'required|date',
////            'total_tax' => 'required|numeric|min:0',
////            'shipping_cost' => 'required|numeric|min:0',
////            'total_discount' => 'required|numeric|min:0',
////            'total_amount' => 'required|numeric|min:0',
////            'paid_amount' => 'required|numeric|min:0',
////            'notes' => 'nullable|string',
////            'status' => 'required|in:1,2,3',
////            'invoice_no' => 'required|string|max:45',
////            'invoice_date' => 'required|date',
////            'items' => 'required|array',
////            'items.*.product_variant_id' => 'required|exists:product_variants,id',
////            'items.*.quantity' => 'required|integer|min:1',
////            'items.*.unit_price' => 'required|numeric|min:0',
////            'items.*.expiry_date' => 'nullable|date',
////            'items.*.purchase_price' => 'required|numeric|min:0',
////            'items.*.sale_price' => 'required|numeric|min:0',
////            'items.*.item_total' => 'required|numeric|min:0',
////            'items.*.old_qty' => 'nullable|integer|min:0',
////            'items.*.old_expiry_date' => 'nullable|date',
////            'items.*.old_expiry_status' => 'nullable|string',
////            'items.*.status' => 'nullable|integer|min:0',
//        ]);
//
////        DB::beginTransaction();
////        try {
//        // Create the PurchasesReturn record
//        $purchasesReturn = PurchasesReturn::create([
//            'supplier_id' => $validatedData['supplier_id'],
//            'created_by' => $validatedData['created_by'],
//            'purchase_date' => $validatedData['purchase_date'],
//            'total_tax' => $validatedData['total_tax'],
//            'shipping_cost' => $validatedData['shipping_cost'],
//            'total_discount' => $validatedData['total_discount'],
//            'total_amount' => $validatedData['total_amount'],
//            'paid_amount' => $validatedData['paid_amount'],
//            'notes' => $validatedData['notes'],
//            'status' => $validatedData['status'],
//            'invoice_no' => $validatedData['invoice_no'],
//            'invoice_date' => $validatedData['invoice_date'],
//        ]);
//
//        // Create the PurchasesReturnItem records
//        foreach ($validatedData['items'] as $itemData) {
//            $item = PurchasesReturnItem::create([
//                'purchase_id' => $purchasesReturn->id,
//                'product_variant_id' => $itemData['product_variant_id'],
//                'quantity' => $itemData['quantity'],
//                'unit_price' => $itemData['unit_price'],
//                'expiry_date' => $itemData['expiry_date'],
//                'purchase_price' => $itemData['purchase_price'],
//                'sale_price' => $itemData['sale_price'],
//                'item_total' => $itemData['item_total'],
//                'old_qty' => $itemData['old_qty'],
//                'old_expiry_date' => $itemData['old_expiry_date'],
//                'old_expiry_status' => $itemData['old_expiry_status'],
//                'status' => $itemData['status'],
//            ]);
//
//            // Deduct quantity from ProductVariant
//            $productVariant = ProductVariant::findOrFail($itemData['product_variant_id']);
//            if ($productVariant->quantity < $itemData['quantity']) {
//                throw new \Exception("Insufficient stock for product variant ID {$itemData['product_variant_id']}");
//            }
//            $productVariant->quantity -= $itemData['quantity'];
//            $productVariant->save();
//        }
////
////            DB::commit();
////
////            return response()->json([
////                'message' => 'Purchase return created successfully',
////                'purchases_return' => $purchasesReturn,
////            ], 201);
////        } catch (\Exception $e) {
////            DB::rollBack();
////
////            return response()->json([
////                'message' => 'Error creating purchase return: ' . $e->getMessage(),
////            ], 500);
////        }
//    }
}
