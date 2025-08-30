<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 *
 * @property $id
 * @property $user_id
 * @property $ticket_process_by
 * @property $subject
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property User $admin
 * @property User $user
 * @property TicketReply[] $ticketReplies
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ticket extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'ticket_process_by', 'subject', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(\App\Models\User::class, 'ticket_process_by', 'id');
    }

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
    public function ticketReplies()
    {
        return $this->hasMany(\App\Models\TicketReply::class, 'id', 'ticket_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('subject', 'like', $term)
            ->where('status', 'like', $term);
    }

}
