<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class TicketMessage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'child_id',
        'message',
        'ticket_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i A',
        'updated_at' => 'datetime:d/m/Y H:i A',
        'deleted_at' => 'datetime:d/m/Y H:i A',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($ticket) {
            $ticket->parent_id = Auth::user()->id ?? 1;
        });
    }

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(User::class, 'child_id');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

}
