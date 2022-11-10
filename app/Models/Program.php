<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'partNumber',
        'machine_id',
        'user_id',
        'partType_id',
        'material_id',
        'materialType',
        'programNameForHead1',
        'programNameForHead2',
        'programTextForHead1',
        'programTextForHead2',
        'partPhoto',
        'materialDiametr',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function partType()
    {
        return $this->belongsTo(PartType::class, 'partType_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function  getLastPrograms(int $count)
    {
        return $this->OrderBy('created_at', 'desc')->with('user')->limit($count)->get();
    }
}
