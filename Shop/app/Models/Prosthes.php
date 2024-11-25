<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Prosthes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specifiable_id',
        'specifiable_type',
        'category_id',
        'creator_id',
        'status',
        'article',
        'name',
        'description',
        'photos',
        'price',
        'year_of_creating',
        'category_creator_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'creator_id' => 'integer',
        'status' => 'boolean',
        'price' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'category_creator_id' => 'integer',
    ];

    // public function photoWishlistCartReviewsProsthesOrderHistoryProsthesOrders(): HasMany
    // {
    //     return $this->hasMany(PhotoWishlistCartReviewsProsthesOrderHistoryProsthesOrder::class);
    // }

    public function categoryCreator(): BelongsTo
    {
        return $this->belongsTo(CategoryCreator::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Creator::class);
    }

    // public function specificationwristspecificationfootspecificationkneespecificationhipspecificationforearmspecificationshoulder(): MorphTo
    // {
    //     return $this->morphTo();
    // }
}
