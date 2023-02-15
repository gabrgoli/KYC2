<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['tx_hash', 'epoch', 'block_height', 'fee'];

    public function utxos() {
        return $this->hasMany(TransactionUtxo::class);
    }
}
