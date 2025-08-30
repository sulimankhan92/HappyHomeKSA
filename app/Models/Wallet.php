<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Wallet
 *
 * @property $id
 * @property $user_id
 * @property $name
 * @property $balance
 * @property $status
 * @property $created_by
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property WalletTransaction[] $walletTransactions
 * @property WalletUsage[] $walletUsages
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Wallet extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'name', 'balance', 'status','created_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function walletTransactions()
    {
        return $this->hasMany(\App\Models\WalletTransaction::class, 'id', 'wallet_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function walletUsages()
    {
        return $this->hasMany(\App\Models\WalletUsage::class, 'id', 'wallet_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('name', 'like', $term)
            ->orWhere('balance', 'like', $term);
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public static function getStatusOptions()
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ];
    }
}
