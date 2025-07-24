<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeDetail extends Model
{
    //
    protected $fillable = [
        
        'fsq_id',
        'name',
        'rating',
        'price',
        'duration',
        'contact',
        'area',
        'bedroom',
        'air_conditioning',
        'bathroom',
        'kitchen',
        'max_pax',
        'hot_water',
        'refrigerator',
        'wifi',
        'tv',
        'main_images',
        'photos', 
        'reviews',
        'alamat'
    ];

    protected $casts = [
        'photos' => 'array', 
        'reviews' => 'array', 
    ];
}
