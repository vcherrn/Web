<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryProsthesOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'prosthes_id',
        'count',
        'history_order_prosthes_id',
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
        'history_order_prosthes_id' => 'integer',
    ];

    public function historyOrderProsthes(): BelongsTo
    {
        return $this->belongsTo(HistoryOrderProsthes::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(HistoryOrder::class);
    }

    public function prosthes(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Prosthes::class);
    }
}
