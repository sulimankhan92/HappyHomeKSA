<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CreditCardController extends Controller
{
    // Get all supported cards
    public function list()
    {
        $cards = CreditCard::where('user_id', Auth::id())->get();
        return response()->json(['status' => 1, 'message' => 'Card details saved successfully', 'cards' => $cards]);
    }

    // Create or update card details
    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_type' => 'required|string|max:255',
            'card_number' => 'required|string|unique:credit_cards,card_number|max:16',
            'holder_name' => 'required|string|max:255',
            'expiry_date' => 'required|string|max:5', // MM/YY
            'cvv' => 'required|string|max:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 0,'message' => 'Validation Error', 'error' => $validator->errors()], 422);
        }

        $card = CreditCard::updateOrCreate(
            ['card_number' => $request->card_number ],
            $request->all() + ['user_id' => Auth::id()]
        );

        $cardDetails = CreditCard::where('id', $card->id)->get();

        return response()->json(['status' => 1, 'message' => 'Card details saved successfully', 'cart_details' => $cardDetails]);
    }

    public function delete_credit_cards(Request $request)
    {
        // Validate the request to ensure a valid credit card ID is provided
        $validated = $request->validate([
            'card_id' => 'required|exists:credit_cards,id',
        ]);

        // Retrieve the credit card by ID
        $card = CreditCard::where('id', $validated['card_id'])
            ->where('user_id', Auth::id())
            ->first();

        if (!$card) {
            return response()->json(['status'=>0, 'message' => 'Credit card not found or unauthorized action.'], 404);
        }

        // Delete the credit card
        $card->delete();

        // Return a success response
        return response()->json(['status'=>1,'message' => 'Credit card deleted successfully.'], 200);
    }

}
