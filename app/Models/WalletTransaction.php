<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WalletTransaction
 *
 * @property $id
 * @property $wallet_id
 * @property $user_id
 * @property $type
 * @property $amount
 * @property $credit
 * @property $debit
 * @property $description
 * @property $order_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Wallet $wallet
 * @property WalletUsage[] $walletUsages
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class WalletTransaction extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['wallet_id', 'user_id', 'type', 'amount', 'credit', 'debit', 'description','order_id'];


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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function walletUsages()
    {
        return $this->hasMany(\App\Models\WalletUsage::class, 'id', 'wallet_transaction_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('type', 'like', $term)
            ->orWhere('amount', 'like', $term);
    }

}
