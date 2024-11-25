<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Guest_Request extends Model
{
    use HasFactory;
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'guest_requests';
    protected $fillable = [
        'request_id',
        'request_status',
        'fullname',
        'country',
        'town',
        'phone',
        'email',
        'details',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'request_id' => 'integer',
        'request_status' => 'boolean',
        'created_at' => 'timestamp',
    ];

    public $timestamps = [
        'created_at'
    ];
    const UPDATED_AT = null;
    public function request(): BelongsTo
    {
        return $this->belongsTo(RequestType::class);
    }
}
