<?php

namespace App\Livewire\Forms;

use App\Models\ProductPromotion;
use Livewire\Form;

class ProductPromotionForm extends Form
{
    public ?ProductPromotion $productPromotionModel;
    
    public $product_details_id = '';
    public $created_by = '';
    public $promotion_price = '';
    public $starting_date = '';
    public $last_date = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'promotion_price' => 'required',
			'starting_date' => 'required',
			'last_date' => 'required',
			'status' => 'required',
        ];
    }

    public function setProductPromotionModel(ProductPromotion $productPromotionModel): void
    {
        $this->productPromotionModel = $productPromotionModel;
        
        $this->product_details_id = $this->productPromotionModel->product_details_id;
        $this->created_by = $this->productPromotionModel->created_by;
        $this->promotion_price = $this->productPromotionModel->promotion_price;
        $this->starting_date = $this->productPromotionModel->starting_date;
        $this->last_date = $this->productPromotionModel->last_date;
        $this->status = $this->productPromotionModel->status;
    }

    public function store(): void
    {
        $this->productPromotionModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->productPromotionModel->update($this->validate());

        $this->reset();
    }
}
