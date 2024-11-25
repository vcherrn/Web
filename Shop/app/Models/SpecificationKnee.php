<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SpecificationKnee extends Model
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
        'amputation_rate',
        'activity_level',
        'max_weight',
        'weight',
        'material',
        'distal_part_connection',
        'proximal_part_connection',
        'knee_angle',
        'system_height_prox',
        'min_system_height_dist',
        'max_system_height_dist',
        'min_montage_height',
        'max_montage_height',
        'proximal_montage_height',
        'min_dist_montage_height',
        'max_dist_montage_height',
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

    public function prosthes(): MorphOne
    {
        return $this->morphOne(Prosthes::class, 'prostheable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
