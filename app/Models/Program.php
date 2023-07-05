<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed $machine_id
 */
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
        'title_1',
        'title_2',
        'text_1',
        'text_2',
        'partPhoto',
        'materialDiameter',
        'description',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function partType(): BelongsTo
    {
        return $this->belongsTo(PartType::class, 'partType_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

}
