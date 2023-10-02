<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'ticket_no',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i A',
        'updated_at' => 'datetime:d/m/Y H:i A',
        'deleted_at' => 'datetime:d/m/Y H:i A',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($ticket) {
            // Generate a random ticket number
            $ticket->ticket_no = 'LZT' . mt_rand(1000, 9999).uniqid();
            $ticket->user_id = Auth::user()->id ?? 1;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
