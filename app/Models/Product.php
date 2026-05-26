<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'currency',
        'stock',
        'sku',
        'is_active',
        'media_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'int',
        'is_active' => 'bool',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}
