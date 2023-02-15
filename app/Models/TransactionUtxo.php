<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionUtxo extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_transaction_id', 'input_output', 'payment_address', 'stake_address', 'value'];

    public function walletTransaction() {
        return $this->hasOne(WalletTransaction::class);
    }
}
