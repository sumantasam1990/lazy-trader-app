<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i A',
        'updated_at' => 'datetime:d/m/Y H:i A',
        'deleted_at' => 'datetime:d/m/Y H:i A',
    ];

    public function lazyfiles(): MorphMany
    {
        return $this->morphMany(LtFile::class, 'model');
    }
}
