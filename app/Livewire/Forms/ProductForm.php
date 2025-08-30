<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $productModel;

    public $secondary_category_id = '';
    public $product_manufacture_id = '';
    public $product_warehouse_id = '';
    public $supplier_id = '';
    public $created_by = '';
    public $name_en = '';
    public $name_ar = '';
    public $description_en = '';
    public $description_ar = '';
    public $order = '';
    public $box_size = '';
    public $barcode = '';
    public $product_location = '';
    public $status = '';
    public $country_id = '';
    public $min_purchase = '';
    public $max_purchase = '';

    public function rules(): array
    {
        return [
			'product_manufacture_id' => 'required',
			'secondary_category_id' => 'required',
			'supplier_id' => 'required',
			'name_en' => 'required|string',
			'name_ar' => 'required|string',
			'description_en' => 'string',
			'description_ar' => 'string',
			'order' => 'required',
			'box_size' => 'required',
			'barcode' => 'required|string',
			'product_location' => 'required|string',
			'status' => 'required',
			'country_id' => 'required',
        ];
    }

    public function setProductModel(Product $productModel): void
    {
        $this->productModel = $productModel;

        $this->secondary_category_id = $this->productModel->secondary_category_id;
        $this->product_manufacture_id = $this->productModel->product_manufacture_id;
        $this->product_warehouse_id = $this->productModel->product_warehouse_id;
        $this->supplier_id = $this->productModel->supplier_id;
        $this->created_by = $this->productModel->created_by;
        $this->name_en = $this->productModel->name_en;
        $this->name_ar = $this->productModel->name_ar;
        $this->description_en = $this->productModel->description_en;
        $this->description_ar = $this->productModel->description_ar;
        $this->order = $this->productModel->order;
        $this->box_size = $this->productModel->box_size;
        $this->barcode = $this->productModel->barcode;
        $this->product_location = $this->productModel->product_location;
        $this->status = $this->productModel->status;
        $this->country_id = $this->productModel->country_id;
        $this->min_purchase = $this->productModel->min_purchase;
        $this->max_purchase = $this->productModel->max_purchase;
    }

    public function store(): Product
    {
        $validatedData = $this->validate();

        $validatedData['created_by'] =  auth()->id();
        $validatedData['product_warehouse_id'] =  1;
        $validatedData['min_purchase'] = $this->min_purchase;
        $validatedData['max_purchase'] = $this->max_purchase;

        $product = $this->productModel->create($validatedData);

//        $this->productModel->create($this->validate());

        $this->reset();

        return $product;
    }

    public function update(): void
    {
        $validatedData = $this->validate();

        $validatedData['created_by'] =  auth()->id();
        $validatedData['min_purchase'] = $this->min_purchase;
        $validatedData['max_purchase'] = $this->max_purchase;
        $this->productModel->update($validatedData);

        $this->reset();
    }
}
