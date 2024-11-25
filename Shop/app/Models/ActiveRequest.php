<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActiveRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'request_id',
        'request_status',
        'name',
        'surname',
        'patronymic',
        'country',
        'town',
        'telephone_number',
        'user_email',
        'message_text',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'request_id' => 'integer',
        'request_status' => 'boolean',
        'created_at' => 'timestamp',
    ];

    public function requestTypeUser(): BelongsTo
    {
        return $this->belongsTo(RequestTypeUser::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(RequestType::class);
    }
}
