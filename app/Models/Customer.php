<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['UUID', 'product_id', 'price_in_ada', 'dust', 'in_wallet_transaction_id', 'out_wallet_transaction_id', 'token_data'];
    protected $casts = ['custom_properties' => 'array'];
}
