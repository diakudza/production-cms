<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'partNumber',
        'count',
        'currentCount',
        'date',
        'completed',
        'inWork',
        'dateCompleted'
    ];

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

}
