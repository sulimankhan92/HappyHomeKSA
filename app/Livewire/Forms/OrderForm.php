<?php

namespace App\Livewire\Forms;

use App\Models\Order;
use Livewire\Form;

class OrderForm extends Form
{
    public ?Order $orderModel;

    public $customer_id = '';
    public $user_order_managed_by = '';
    public $user_order_collected_by = '';
    public $user_order_delivered_by = '';
    public $payment_method_id = '';
    public $delivery_package_id = '';
    public $product_total = '';
    public $total_tax = '';
    public $delivery_cost = '';
    public $total_discount = '';
    public $total_amount = '';
    public $total_amount_paid = '';
    public $notes = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'customer_id' => 'required',
			'user_order_managed_by' => 'required',
			'user_order_collected_by' => 'required',
			'user_order_delivered_by' => 'required',
			'product_total' => 'required',
			'total_tax' => 'required',
			'delivery_cost' => 'required',
			'total_discount' => 'required',
			'total_amount' => 'required',
			'total_amount_paid' => 'required',
			'notes' => 'string',
			'status' => 'required',
        ];
    }

    public function setOrderModel(Order $orderModel): void
    {
        $this->orderModel = $orderModel;

        $this->customer_id = $this->orderModel->customer_id;
        $this->user_order_managed_by = $this->orderModel->user_order_managed_by;
        $this->user_order_collected_by = $this->orderModel->user_order_collected_by;
        $this->user_order_delivered_by = $this->orderModel->user_order_delivered_by;
        $this->payment_method_id = $this->orderModel->payment_method_id;
        $this->delivery_package_id = $this->orderModel->delivery_package_id;
        $this->product_total = $this->orderModel->product_total;
        $this->total_tax = $this->orderModel->total_tax;
        $this->delivery_cost = $this->orderModel->delivery_cost;
        $this->total_discount = $this->orderModel->total_discount;
        $this->total_amount = $this->orderModel->total_amount;
        $this->total_amount_paid = $this->orderModel->total_amount_paid;
        $this->notes = $this->orderModel->notes;
        $this->status = $this->orderModel->status;
    }

    public function store(): void
    {
        $this->orderModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->orderModel->update($this->validate());

        $this->reset();
    }
}
