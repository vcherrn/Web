<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SpecificationHip extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'product_type',
        'activity_level',
        'max_weight',
        'weight',
        'distal_part_connection',
        'proximal_part_connection',
        't_angle',
        'system_height',
        'montage_height',
        'type_of_side',
        'material',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
    ];
    protected $table = 'specification_hips';
    public function prosthes(): MorphOne
    {
        return $this->morphOne(Prosthes::class, 'prostheable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
