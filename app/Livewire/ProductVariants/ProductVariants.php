<?php

namespace App\Livewire\ProductVariants;
use App\Livewire\Forms\ProductForm;
use App\Livewire\Forms\ProductVariantForm;
use App\Models\Product;
use App\Models\ProductPacking;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Layout;
use App\Models\ProductVariant;
use Livewire\Component;

class ProductVariants extends Component
{
    public $product_var = [];
    public $productPackingDetails = [];
    public $productVariant;
    public $weight;
//    public $quantity;
    public $quantity_alerts;
    public $product_id;
    public $status;
    public $unit_id;
//    public $expiry_date;
    public $expiry_date_alerts;
    public $productVariantId;
    public $packing_quantity;
    public $packaging_level;
    public $packaging_status;
    public $created_by;

    public $isEditMode = false;

//    public ProductVariantForm $form;
    protected $rules = [
        'weight' => 'required',
//        'quantity' => 'required',
        'quantity_alerts' => 'required',
        'status' => 'required',
        'unit_id' => 'required',
        'expiry_date_alerts' => 'required',
    ];

    public function mount($productVariant)
    {
        $this->productVariant = $productVariant;
        $this->product_id = $productVariant; // assuming productVariant is the product ID
        $this->packaging_status = $this->packaging_status ?? '0';
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $productVariants = ProductVariant::where('product_id', $this->product_id)->with('productDetails.productPacking')->get();
//       dd($productVariants);
        $product = Product::with(['secondaryCategories'])->findOrFail($this->product_id);
        return view('livewire.product-variant.productVariant', [
            'productVariants' => $productVariants,
            'product' => $product,
        ]);
    }

    public function createProductVariant()
    {
        $validatedData = $this->validate();
        $validatedData['product_id'] = $this->product_id;
        $validatedData['created_by'] = auth()->id();
        if ($this->isEditMode) {
            $productVariant = ProductVariant::findOrFail($this->product_var->id);
            $productVariant->update($validatedData);
            $this->isEditMode = false;
        } else {
            ProductVariant::create($validatedData);
        }
//        if ($this->isEditMode) {
//            $productVariant = ProductVariant::findOrFail($this->product_var->id);
//            $this->product_var->weight = $this->weight;
//            $this->product_var->quantity_alerts = $this->quantity_alerts;
////            $this->product_var->quantity = $this->quantity;
//            $this->product_var->product_id = $this->product_id;
//            $this->product_var->unit_id = $this->unit_id;
////            $this->product_var->expiry_date = $this->expiry_date;
//            $this->product_var->expiry_date_alerts = $this->expiry_date_alerts;
//            $this->product_var->status = $this->status;
//            $this->product_var->save();
//            $this->isEditMode = false;
//        }else{
//            ProductVariant::create([
//                'weight' => $this->weight,
//                'quantity_alerts' => $this->quantity_alerts,
////                'quantity' => $this->quantity,
//                'product_id' => $this->product_id,
//                'unit_id' => $this->unit_id,
////                'expiry_date' => $this->expiry_date,
//                'expiry_date_alerts' => $this->expiry_date_alerts,
//                'status' => $this->status,
//                'created_by' => auth()->id(),
//            ]);
//        }

        $this->resetForm();
        $this->dispatch('closeModal');
    }

//    public function getAttributes() {
//        return [
//            'weight' => $this->weight,
//            'quantity' => $this->quantity,
//            'product_id' => $this->product_id,
//            'unit_id' => $this->unit_id,
//            'expiry_date' => $this->expiry_date,
//            'expiry_date_alerts' => $this->expiry_date_alerts,
//            'status' => $this->status,
//            'created_by' => auth()->id(),
//        ];
//    }

    public function editProductVariant(int $id)
    {
        $this->product_var = ProductVariant::findOrFail($id);
        $this->isEditMode = true;
        $this->weight = $this->product_var->weight;
        $this->unit_id = $this->product_var->unit_id;
        $this->quantity_alerts = $this->product_var->quantity_alerts;
//        $this->quantity = $this->product_var->quantity;
        $this->status = $this->product_var->status;
//        $this->expiry_date = $this->product_var->expiry_date;
        $this->expiry_date_alerts = $this->product_var->expiry_date_alerts;
        $this->dispatch('openModal');
    }

    public function resetForm()
    {
        $this->weight = '';
        $this->unit_id = '';
        $this->quantity_alerts = '';
//        $this->quantity = '';
        $this->status = '';
//        $this->expiry_date = '';
        $this->expiry_date_alerts = '';
    }

    public function openProductPackingModal($productVariantId)
    {
        $this->productVariantId = $productVariantId;
        $this->productPackingDetails = ProductPacking::all();
        $this->dispatch('openPackingModal', ['productVariantId' => $productVariantId]);
    }

    public function createProductPacking(){
//        dd($this->packaging_status);
//        productVariantId
//        packing_quantity
        $this->packing_level = $this->packing_level;
        $this->packing_quantity = $this->packing_quantity;
        $this->packaging_status = $this->packaging_status;
        $this->product_var->save();
    }

}
