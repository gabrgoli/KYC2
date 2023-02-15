<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionAsset extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_utxo_id', 'policy_id', 'asset_name','quantity'];

    public function utxo() {
        return $this->hasOne(TransactionUtxo::class);
    }
}
