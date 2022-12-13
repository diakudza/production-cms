<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartType extends Model
{
    use HasFactory;

    protected $table = 'partTypes';

    protected $fillable = ['title'];

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class, 'partType_id');
    }
}
