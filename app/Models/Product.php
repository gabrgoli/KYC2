<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price_in_ada', 'outlink', 'custom_attributes'];
    protected $casts = ['custom_properties' => 'array'];
}
