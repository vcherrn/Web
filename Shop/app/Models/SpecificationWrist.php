<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SpecificationWrist extends Model
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
        'type_of_side',
        'arm_size',
        'voltage',
        'temperature',
        'opening_width',
        'gripping_power',
        'gripping_speed',
        'weight',
        'color',
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
        'voltage' => 'decimal:2',
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
