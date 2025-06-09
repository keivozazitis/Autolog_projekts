<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivataisKatalogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
    ];
}
