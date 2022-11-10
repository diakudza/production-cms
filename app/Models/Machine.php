<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'ip',
        'repair',
        'created_at'
    ];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
