<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WalletUsage
 *
 * @property $id
 * @property $wallet_id
 * @property $wallet_transaction_id
 * @property $user_id
 * @property $order_id
 * @property $amount_used
 * @property $created_at
 * @property $updated_at
 *
 * @property Order $order
 * @property User $user
 * @property Wallet $wallet
 * @property WalletTransaction $walletTransaction
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class WalletUsage extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['wallet_id', 'wallet_transaction_id', 'user_id', 'order_id', 'amount_used'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wallet()
    {
        return $this->belongsTo(\App\Models\Wallet::class, 'wallet_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function walletTransaction()
    {
        return $this->belongsTo(\App\Models\WalletTransaction::class, 'wallet_transaction_id', 'id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('amount_used', 'like', $term);
    }

}
