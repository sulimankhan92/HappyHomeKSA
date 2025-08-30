<?php

namespace App\Http\Controllers;

use App\Models\DeliveryTime;
use App\Models\OrderWorkDay;
use Illuminate\Http\Request;

class DeliveryTimeController extends Controller
{
    public function index($id)
    {
        $deliveryTimeSlots = DeliveryTime::where('order_work_day_id',$id)->get();
        $deliveryTimeSlots->order_work_day_id = $id;
        return view('delivery_times.index', compact('deliveryTimeSlots'));
    }

    public function create($id){
        $delivery_time = new OrderWorkDay();
        $delivery_time->order_work_day_id = $id;
        return view('delivery_times.create',compact('delivery_time'));
    }

    public function store(Request $request){
        DeliveryTime::create($request->all());
        return redirect('working_days_time_slots/'.$request->order_work_day_id)->with('success', 'Time Slot is created successfully.');
    }

    public function edit($id, $wid)
    {
        // Retrieve the delivery time by ID
        $delivery_time = DeliveryTime::find($id);

        // Debugging to ensure data retrieval is correct
        if (!$delivery_time) {
            return redirect()->route('delivery-times.index')->withErrors('Delivery time not found.');
        }
        return view('delivery_times.edit', compact('delivery_time', 'wid'));
    }

    public function update(Request $request, $id)
    {
        // Find the delivery time
        $delivery_time = DeliveryTime::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'time_slot' => 'required|string',
        ]);

        // Update the delivery time fields
        $delivery_time->update($validatedData + ['status'=>$request->status]);
        return redirect()->route('working_days_time_slots', ['id' => $delivery_time->order_work_day_id])
            ->with(['message'=>'Delivery time not found.']);
    }

    public function toggleStatus($id)
    {
        $deliveryTime = DeliveryTime::findOrFail($id);

        // Toggle the status between 0 and 1
        $deliveryTime->status = $deliveryTime->status ? 0 : 1;

        $deliveryTime->save();

        return redirect()->back()
            ->with('success', 'Delivery time status updated successfully.');
    }

    public function toggleWeekDayStatus($id)
    {
        $deliveryTime = OrderWorkDay::findOrFail($id);

        // Toggle the status between 0 and 1
        $deliveryTime->is_work_day = $deliveryTime->is_work_day ? 0 : 1;

        $deliveryTime->save();

        return redirect()->back()
            ->with('success', 'Work Day time status updated successfully.');
    }

    public function updateDeliveriesPerDay(Request $request, $id)
    {
        $deliveryTime = OrderWorkDay::findOrFail($id);

        // Toggle the status between 0 and 1
        $deliveryTime->deliveries_per_day = $request->deliveries_per_day ?? 200;

        $deliveryTime->save();

        return redirect()->back()
            ->with('success', 'Work Day time status updated successfully.');
    }

}
