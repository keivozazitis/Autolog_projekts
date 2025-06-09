<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'price',
        'body_type',
        'fuel_type',
        'transmission',
        'engine_volume',
        'mileage',
        'color',
        'license_plate',
        'vin',
        'next_inspection',
        'description',
        'prev_inspection_rating',
        'prev_inspection_problem',
        'user_id',
    ];
    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }
}
