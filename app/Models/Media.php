<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'user_id',
        'disk',
        'path',
        'original_name',
        'mime_type',
        'size',
        'width',
        'height',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'size' => 'int',
        'width' => 'int',
        'height' => 'int',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
