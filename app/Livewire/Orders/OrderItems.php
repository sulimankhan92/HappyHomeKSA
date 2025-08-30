<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;


class OrderItems extends Component
{
    public $order_id = '';
    public $username = '';

    public function mount($order)
    {
        $this->order_id = $order;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $orderItems = Order::where('id', $this->order_id)
            ->with([
                'customer',
                'paymentMethod',
                'orderItems.productDetail.productVariant.product',
                'orderItems.productDetail.productPacking'
                ])
            ->first();

        $class = 'badge-success';
        if($orderItems->paymentMethod->id ==1)
            $class = 'badge-info';

        $class = [
            'paymentBadgeClass' => $class
        ];

        $users = [];
        if(empty(!$this->username))
        {
            $term = '%' . $this->username . '%';
            $users = User::where('name', 'like', $term)->get();
        }

        return view('livewire.order.order-items',
            ['order' => $orderItems,'class'=>$class, 'users'=>$users]
        );
    }

    public function addCollector($username){
        $this->username = $username;
    }

}
