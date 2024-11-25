<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'isactive',
        'ispayed',
        'payment_method',
        'surname',
        'patronymic',
        'country',
        'town',
        'area',
        'street',
        'house',
        'apartment',
        'telephone_number',
        'user_email',
        'message_text',
        'order_sum',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'order_sum' => 'decimal:2',
        'created_at' => 'timestamp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prosthesOrders(): HasMany
    {
        return $this->hasMany(ProsthesOrder::class);
    }
}
