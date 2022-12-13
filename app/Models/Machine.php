<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'ip',
        'repair',
        'created_at',
        'machinePhoto',
        'comment'
    ];

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
