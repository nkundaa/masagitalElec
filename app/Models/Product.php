<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'category',
        'price',
        'original_price',
        'image',
        'short_description',
        'description',
        'specifications',
        'how_it_works',
        'youtube_video_id',
        'tutorial_title',
        'in_stock',
        'rating',
        'reviews',
        'badge'
    ];

    protected $casts = [
        'specifications' => 'array',
        'how_it_works' => 'array',
        'in_stock' => 'boolean',
        'rating' => 'double',
        'reviews' => 'integer',
        'price' => 'integer',
        'original_price' => 'integer',
    ];
}
