<?php

namespace App\Http\Controllers;

use App\Models\ProductDetail;
use App\Models\ProductVariant;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Services\ProductHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    protected $productHistoryService;

    public function __construct(ProductHistoryService $productHistoryService)
    {
        $this->productHistoryService = $productHistoryService;
    }

    public function create()
    {
        $suppliers = Supplier::where('status',2)->get();
        return view('purchase.create', compact('suppliers'));
    }

    public function store_new_stock(Request $request)
    {
        $invoice = Purchase::create([
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
                $product_variant->quantity += $request['new_stocks'][$key];
                $product_variant->expiry_date = $request['expiry_dates'][$key];
                $product_variant->save();
            }

            $purchases_items = PurchaseItem::create([
                'purchase_id' => $invoice->id,
                'product_variant_id' => $request['variant_ids'][$key],
                'quantity' => $request['new_stocks'][$key],
                'purchase_price' => $request['purchase_prices'][$key],
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
                'Product Purchases',
                'Product is Add To Stock Purchases # '. $invoice->id . ' Invoice # ' .$request->invoice_no,
                Auth::id(),
                1,
                'PURCHASES'
            );
        }

        return redirect()->route('purchases.index')->with('success', 'Product purchases is successfully add!');
    }

    public function edit($id)
    {
        $suppliers = Supplier::where('status', 1)->get();
        $purchase = Purchase::with(['purchaseItems' => function ($query) {
            $query->where('status', 1)->with('productVariant.product');
        }])->findOrFail($id);
        return view('purchase.edit', compact('purchase', 'suppliers'));
    }

    public function update(Request $request)
    {
        $purchase = Purchase::findOrFail($request->purchase_id);
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

        // Loop through the purchase items to update them
        foreach ($request['product_ids'] as $key => $product_id) {

            if($request['purchase_item_ids'][$key]=='1')
            {
                $product_variant = ProductVariant::find($request['variant_ids'][$key]);
                if ($product_variant) {
                    $old_qty = $product_variant->quantity;
                    $old_expiry_date = $product_variant->expiry_date;
                    $product_variant->quantity = $request['new_stocks'][$key];
                    $product_variant->expiry_date = $request['expiry_dates'][$key];
                    $product_variant->save();
                }

                $purchases_items = PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_variant_id' => $request['variant_ids'][$key],
                    'quantity' => $request['new_stocks'][$key],
                    'purchase_price' => $request['purchase_prices'][$key],
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
                    'Update Product Purchases',
                    'Product is Add To Stock Purchases Invoice # '. $purchase->id,
                    Auth::id(),
                    1,
                    'PURCHASES'
                );

            }

            //If item is removed from list
            if(isset($request['delete_items'][$key]))
            {
                $product_variant = ProductVariant::find($request['variant_ids'][$key]);
                if ($product_variant) {
                    $qty  = $product_variant->quantity - $request['new_stocks'][$key];
                    $product_variant->quantity = $qty;
                    $product_variant->save();

                    $this->productHistoryService->createProductHistory(
                        $request['variant_ids'][$key],
                        null,
                        $request['new_stocks'][$key],
                        'Remove Product Variant',
                        'Product return from Stock Purchases Invoice # '. $purchase->id,
                        Auth::id(),
                        1,
                        'PURCHASES_RETURN'
                    );
                }

                $purchases_item = PurchaseItem::find($request['delete_items'][$key]);
                if ($purchases_item) {
                    $purchases_item->status = 0;
                    $purchases_item->save();
                }

                $total_bill = (float)$purchase->total_amount - (float)$request['item_total'][$key];
                $purchase->update([
                    'total_amount' => $total_bill,
                    'paid_amount' => $total_bill,
                ]);

            }

        }

        return redirect()->route('purchases.index')->with('success', 'Product purchases is successfully add!');
    }
}
