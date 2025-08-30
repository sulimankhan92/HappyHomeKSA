<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
//    public function index()
//    {
//        $purchases = PurchaseReturn::all();
//        return view('purchase-return.index', compact('purchases'));
//    }

    public function create(){
        return view('purchase-return.create');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->get('query');
        $purchase = Purchase::where('invoice_no', 'LIKE', '%' . $searchTerm . '%')->get(['id', 'invoice_no']);

        return response()->json([
            'purchases' => $purchase
        ]);
    }

    public function findPurchase(Request $request){
        $purchase_invoice_id = $request->purchase_invoice_id;
        $suppliers = Supplier::where('status', 1)->get();
        $purchase = Purchase::with(['purchaseItems' => function ($query) {
            $query->where('status', 1)->with('productVariant.product');
        }])->findOrFail($purchase_invoice_id);
        return view('purchase-return.create', compact('purchase', 'suppliers'));

//        $purchase_invoice_id = $request->purchase_invoice_id;
//        $purchase = Purchase::with(['purchaseItems' => function ($query) {
//            $query->where('status', 1)->with('productVariant.product');
//        }])->findOrFail($purchase_invoice_id);
//        return view('purchase.edit', compact('purchase'));
//        return view('purchase.edit', compact('purchase'));
    }

    public function returnPurchase(Request $request)
    {
        $purchaseReturn = PurchaseReturn::create([
            'purchase_id' => $request->invoice_id, // purchase ID for return
            'return_date' => now(),
            'reason' => $request->reason,
            'invoice_no' => $request->invoice_no,
            'total_return_amount' => 0,
        ]);

        foreach ($request['item_ids'] as $index => $itemId) {
            if (in_array($itemId, $request['return_purchases'])) {
                $returnQuantity = $request['return_quantity'][$index];
                if (!empty($returnQuantity) && $returnQuantity > 0) {

                    $productVariant = ProductVariant::class::find($request['variant_ids'][$index]);
                    $quantity = $productVariant->quantity - $returnQuantity;
                    $productVariant->quantity = $quantity;
                    $productVariant->save();

                    $totalReturnAmount = $returnQuantity*$request['purchase_prices'][$index];
                    $purchase_return_item = new PurchaseReturnItem();
                    $purchase_return_item->purchase_return_id = $purchaseReturn->id;
                    $purchase_return_item->purchase_item_id = $itemId;
                    $purchase_return_item->product_variant_id = $request['variant_ids'][$index];
                    $purchase_return_item->quantity_returned = $returnQuantity;
                    $purchase_return_item->expiry_date = $request['expiry_dates'][$index];
                    $purchase_return_item->reason_for_return = $request->reason;
                    $purchase_return_item->refund_amount = $totalReturnAmount;
                    $purchase_return_item->save();
                }
            }
        }
//        return redirect()->back()->with(['message'=>'success']);
        return redirect('purchase-returns');
    }

}
