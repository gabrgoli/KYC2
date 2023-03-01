<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\LookupValue;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckIncomingPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iamx:checkIncomingPayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks incoming payments to the IAMX wallet address';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        Log::channel('iamxlog')->info('checkIncomingPayment Start');

        $wallet_address = LookupValue::where('param_name', 'wallet_address')->first();
        $iamx_wallet_address = $wallet_address->param_value;

        $openIncomingPayments = Customer::where('in_wallet_transaction_id', '=', null)->get();
        foreach ($openIncomingPayments as $openIncomingPayment) {

            $dust = str_pad($openIncomingPayment->dust, 5, '0', STR_PAD_LEFT);
            $paymentAmount = (float)$openIncomingPayment->price_in_ada.'.'.$dust;

            $payment = DB::table('transaction_utxos')
                ->selectRaw(
                    'distinct x.value / 1000000 as value
                    , wallet_transactions.tx_hash as tx_in_hash
                    , x.value as payment_amount'
                )
                ->join('wallet_transactions', 'transaction_utxos.wallet_transaction_id', '=', 'wallet_transactions.id')
                ->join('transaction_utxos as x','x.wallet_transaction_id', '=' ,'transaction_utxos.wallet_transaction_id')
                ->where('x.input_output', '=', 'output')
                ->where('x.payment_address', '=', $iamx_wallet_address)
                ->where('x.value', '=', $paymentAmount)
                ->where('wallet_transactions.block_height', '>=', $openIncomingPayment->started_after_blockheight)
                ->get();


            if($payment->isNotEmpty()) {

                Log::channel('iamxlog')->info('Payment found for customer_id : ' . $openIncomingPayments->id.' tx-hash: '.$payment->first()->tx_in_hash);

                $openIncomingPayment->out_wallet_transaction_id = $payment->first()->tx_in_hash;
                $openIncomingPayment->save();
            }
        }

        Log::channel('iamxlog')->info('checkIncomingPayment End');

    }
}
