<?php

namespace App\Http\Controllers\Api;

use App\Models\Otp;
use Illuminate\Http\Request;
use App\Http\Requests\OtpRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OtpResource;

class OtpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(['message' => 'Login route works!']);
        $otps = Otp::paginate();

        return OtpResource::collection($otps);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OtpRequest $request): Otp
    {
        return Otp::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Otp $otp): Otp
    {
        return $otp;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OtpRequest $request, Otp $otp): Otp
    {
        $otp->update($request->validated());

        return $otp;
    }

    public function destroy(Otp $otp): Response
    {
        $otp->delete();

        return response()->noContent();
    }
}
