<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class LtFile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'model',
        'file',
        'ext',
        'original_name',
    ];

    protected $appends = [
        'file_url'
    ];
    public function getFileUrlAttribute()
    {
        return $this->attributes['file'] ? Storage::disk('public')->url($this->attributes['file']) : '';
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
