<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prosthes_id',
        'user_id',
        'rate',
        'm_text',
        'user_prosthes_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'prosthes_id' => 'integer',
        'user_id' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'user_prosthes_id' => 'integer',
    ];

    public function userProsthes(): BelongsTo
    {
        return $this->belongsTo(UserProsthes::class);
    }

    public function prosthes(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Prosthes::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
