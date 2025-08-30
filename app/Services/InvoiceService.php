<?php

namespace App\Services;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceService
{


    public function generateOrderInvoice($order_id)
    {



        $order = Order::where('id', $order_id)
            ->with([
                'customer',
                'paymentMethod',
                'orderItems.productDetail.productVariant.product',
                'orderItems.productDetail.productPacking',
                'deliveryAddress',
                'deliveryDay',
                'deliveryTime'
            ])
            ->first();
// dd($order);
        $pdf = Pdf::loadView('invoice.order', ['order' => $order])
            ->setPaper('a4', 'portrait')

            ->setOption('enable-local-file-access', true)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('remote_enabled', true);
        $pdf->set_option('defaultFont', 'DejaVu Sans');
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isRemoteEnabled', true);
        return $pdf->stream('invoice-'.$order->id.'.pdf');
    }


//     public function generateOrderInvoice($order_id)
//     {
// //        $order = Order::with([
// //            'orderItems.productDetail.productVariant.product.productFirstimage','deliveryCaptain'
// //            ])
// //        ->where('id', $order_id)
// //        ->get();

//         $order = Order::where('id', $order_id)
//             ->with([
//                 'customer',
//                 'paymentMethod',
//                 'orderItems.productDetail.productVariant.product',
//                 'orderItems.productDetail.productPacking'
//             ])
//             ->first();

//                 $html = view('invoice.order', ['order'=>$order])->render();

//     return Pdf::loadHTML($html)
//         ->setPaper('a4', 'portrait')
//         ->stream('invoice.pdf');

//         $pdf = Pdf::loadView('invoice.order', ['order'=>$order]);

//         // Return the PDF for download or directly display it in the browser
//         return $pdf->stream('invoice.pdf');

// //        return Pdf::loadView('invoice.order', $order)->stream('invoice.pdf');
//     }

    public function generateSpacifiedInvoice($data)
    {
        return Pdf::loadView('pdf.invoice', $data)->stream('invoice.pdf');
    }
}
