<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketReply
 *
 * @property $id
 * @property $ticket_id
 * @property $user_id
 * @property $message
 * @property $is_user
 * @property $language
 * @property $created_at
 * @property $updated_at
 *
 * @property Ticket $ticket
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TicketReply extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['ticket_id', 'user_id', 'message', 'is_user', 'language'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(\App\Models\Ticket::class, 'ticket_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
