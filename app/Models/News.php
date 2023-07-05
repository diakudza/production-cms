<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'user_id',
        'text',
        'public',
        'image',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
