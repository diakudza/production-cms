<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartType extends Model
{
    use HasFactory;

    protected $table = 'partTypes';

    public function programs()
    {
        return $this->hasMany(Program::class, 'partType_id');
    }
}
