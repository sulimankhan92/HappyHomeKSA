<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function create()
    {
        $wallet = new Wallet();
        $status = Wallet::getStatusOptions();
        return view('wallet.create', compact('wallet', 'status'));
    }

    public function store(WalletRequest $request)
    {
        $wallet = Wallet::create($request->all() + [
            'created_by' => auth()->id(),
            'status' => 1
        ]);

        //wallet_balance
        $user = User::where('id', $request->user_id)->firstOrFail();
        $user->increment('wallet_balance', $request->balance);

        WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'user_id' => $request->user_id,
            'type' => 'DR',
            'amount' => $request->balance,
            'debit' => $request->balance,
            'credit' => 0,
//            'description' => $request->description ?? null,
            'created_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Product Brand created successfully.');
    }

    public function edit($brand)
    {
        $wallet = Wallet::findOrFail($brand);
        $status = Wallet::getStatusOptions();
        $selectedUser = User::find($wallet->user_id);
        return view('wallet.edit', compact('wallet', 'status', 'selectedUser'));
    }

    public function update(WalletRequest $request, Wallet $wallet)
    {
        $wallet->update($request->all() + [
                'updated_by'=>auth()->id(),
            ]);

        $transaction = WalletTransaction::where('wallet_id', $wallet->id)->first();

        $transaction->update([
        'wallet_id' => $wallet->id,
            'user_id' => $request->user_id,
            'type' => 'DR',
            'amount' => $request->balance,
            'debit' => $request->balance,
//            'description' => $request->description ?? null,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('wallets.index')->with('success', 'wallet points updated successfully!');
    }

    public function search_user(Request $request)
    {
        $term = $request->get('query', ''); // Fetch the 'query' parameter

        $users = User::where('phone_number', 'like', "%{$term}%")
            ->OrWhere('name', 'like', "%{$term}%")
            ->limit(10)
            ->get();

        return response()->json([
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name . ' ' .$user->phone_number,
                ];
            }),
        ]);
    }


//    public function search_user(Request $request)
//    {
//            $term = $request->get('term');
//
//            $results = User::where('name', 'like', "%{$term}%")
//                ->limit(10)
//                ->get();
//
//        return response()->json([
//            'users' => $results
//        ]);
//    }

}
