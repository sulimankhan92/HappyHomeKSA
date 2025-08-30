<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderTicket
 *
 * @property $id
 * @property $user_id
 * @property $order_id
 * @property $ticket_process_by_user
 * @property $subject
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Order $order
 * @property User $user
 * @property User $ticket_process_admin
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OrderTicket extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'order_id', 'ticket_process_by_user', 'subject', 'status'];


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
    public function ticket_process_admin()
    {
        return $this->belongsTo(\App\Models\User::class, 'ticket_process_by_user', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('subject', 'like', $term)
            ->where('status', 'like', $term);
    }

}
