<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->is_default) && !empty($request->is_default)){
            $addresses = UserAddress::where(['user_id'=> Auth::id(), 'is_default'=>1])->get();
        }else{
            $addresses = UserAddress::where(['user_id'=> Auth::id(), 'status'=>1])->get();
        }

        return response()->json($addresses);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required|string',
            'type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=> 0,
                'message' => 'Please fill out all fields',
                'error' => $validator->errors()
            ], 422);
        }

        $address = UserAddress::create($request->all() + ['user_id' => Auth::id()]);

        return response()->json([
            'status'=>1,
            'message'=>'Success',
            'address' => $address
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
            'address' => 'required|string',
            'type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=> 0,
                'message' => 'Please fill out all fields',
                'error' => $validator->errors()
            ], 422);
        }

        $address = UserAddress::find($request->address_id);

        if($address){
            $address->update($request->all());
            // return response()->json($address);

            return response()->json([
                'status' => 1,
                'message'=> 'successfully updated',
                'address'=> $address
            ]);
        }

        return response()->json([
            'status'=> 0,
            'message' => 'error address not found.',
        ], 422);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=> 0,
                'message' => 'Please fill out all fields',
                'error' => $validator->errors()
            ], 422);
        }

        $address = UserAddress::find($request->address_id);
        if($address){
            $address->update(['status'=>0]);
        }

        return response()->json(['status'=>1,'message'=>'success']);
    }

    public function setAddressAsSelected(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=> 0,
                'message' => 'Please fill out all fields',
                'error' => $validator->errors()
            ], 422);
        }

        UserAddress::where(['user_id' => Auth::id(), 'is_select' => 1])
            ->update(['is_select' => 0]);

        $address = UserAddress::find($request->address_id);
        if($address){
            $address->update(['is_select' => 1]);
            return response()->json(['status'=>1,'message'=>'success']);
        }

        return response()->json(['status'=>0,'message'=>'error address not found.']);
    }

}
