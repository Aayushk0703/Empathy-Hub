<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'age',
        'gender',
        'service',
        'session_mode',
        'preferred_date',
        'preferred_time',
        'alternate_date',
        'alternate_time',
        'previous_therapy',
        'concerns',
        'additional_notes',
        'status',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'alternate_date' => 'date',
        'age' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
