<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SpecificationForearm extends Model
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
        'max_fingers_load',
        'max_weight',
        'working_time',
        'functions',
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
        'max_weight' => 'decimal:2',
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
