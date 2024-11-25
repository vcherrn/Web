<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProsthesOrder extends Model
{
    use HasFactory;
    protected $table = 'prosthes_orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'prosthes_id',
        'count',
        'side',
        'specification',
        'price',
        'created_at',
        'updated_at',
        'order_prosthes_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'prosthes_id' => 'integer',
        'created_at' => 'timestamp',
        'order_prosthes_id' => 'integer',
    ];

    // public function orderProsthes(): BelongsTo
    // {
    //     return $this->belongsTo(OrderProsthes::class);
    // }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function prosthes(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Prosthes::class);
    }
}
