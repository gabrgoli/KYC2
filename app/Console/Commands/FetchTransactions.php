<?php

namespace App\Console\Commands;

use App\Models\LookupValue;
use App\Models\TransactionAsset;
use App\Models\TransactionUtxo;
use App\Models\WalletTransaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::channel('iamxlog')->info('fetchTransactions Start');

        $walletAddress = LookupValue::where('param_name', 'wallet_address')->first();
        $lastBlockHeight = LookupValue::where('param_name', 'last_block_height')->first();
        $blockHeight = $lastBlockHeight->param_value;
        $iamxWalletAddress = [$walletAddress->param_value];

        $addressTransactions = $this->getTransactions($iamxWalletAddress, $blockHeight);
        $transactionArray = [];
        $walletTransaction = null;
        for($i = 0; $i < count($addressTransactions); $i++) {
            array_push($transactionArray, $addressTransactions[$i]->tx_hash);
            $walletTransaction = WalletTransaction::firstOrCreate(
                ['tx_hash' => $addressTransactions[$i]->tx_hash]
            );
        }

        $transactionInfos = $this->getTransactionInfos($transactionArray);
        $blockHeights = [];

        foreach($transactionInfos as $info) {
            $walletTransaction = WalletTransaction::where('tx_hash', $info->tx_hash)->first();
            $walletTransaction->block_height = $info->block_height;
            $walletTransaction->epoch = $info->epoch_no;
            $walletTransaction->fee = $info->fee;
            $walletTransaction->save();

            array_push($blockHeights, $info->block_height);

            $inputs = $info->inputs;
            $outputs = $info->outputs;
            foreach ($outputs as $output) {
                $transactionUtxo = new TransactionUtxo();
                $transactionUtxo->wallet_transaction_id = $walletTransaction->id;
                $transactionUtxo->input_output = 'output';
                $transactionUtxo->payment_address = $output->payment_addr->bech32;
                $transactionUtxo->stake_address = $output->stake_addr;
                $transactionUtxo->value = $output->value;
                $transactionUtxo->save();

                $outputAssets = $output->asset_list;
                foreach ($outputAssets as $outputAsset) {
                    $transactionAsset = new TransactionAsset();
                    $transactionAsset->transaction_utxo_id = $transactionUtxo->id;
                    $transactionAsset->policy_id = $outputAsset->policy_id;
                    $transactionAsset->asset_name = $outputAsset->asset_name;
                    $transactionAsset->quantity = $outputAsset->quantity;
                    $transactionAsset->save();
                }
            }

            foreach ($inputs as $input) {
                $transactionUtxo = new TransactionUtxo();
                $transactionUtxo->wallet_transaction_id = $walletTransaction->id;
                $transactionUtxo->input_output = 'input';
                $transactionUtxo->payment_address = $input->payment_addr->bech32;
                $transactionUtxo->stake_address = $input->stake_addr;
                $transactionUtxo->value = $input->value;
                $transactionUtxo->save();

                $inputAssets = $input->asset_list;
                foreach ($inputAssets as $inputAsset) {
                    $transactionAsset = new TransactionAsset();
                    $transactionAsset->transaction_utxo_id = $transactionUtxo->id;
                    $transactionAsset->policy_id = $inputAsset->policy_id;
                    $transactionAsset->asset_name = $inputAsset->asset_name;
                    $transactionAsset->quantity = $inputAsset->quantity;
                    $transactionAsset->save();
                }
            }
        }

        if (!empty($blockHeights)) {
            DB::table('lookup_values')
                ->where('param_name', '=', 'last_block_height')
                ->update(['paran_value' => max($blockHeights) + 1]);
        }

        Log::channel('iamxlog')->info('fetchTransactions End');
        return Command::SUCCESS;
    }

    private function getTransactions($paymentAddress, $blockHeight) {

        $responseAddressTransactions = Http::retry(5, 100)->timeout(5)->post('https://api.koios.rest/api/v0/address_txs', [
            '_addresses' => $paymentAddress,
            '_after_block_height' => $blockHeight
        ]);
        return (array) json_decode($responseAddressTransactions->body());
    }

    private function getTransactionInfos($txHashes) {
        $responseTransactionUTxOs = Http::retry(5, 100)->timeout(5)->post('https://api.koios.rest/api/v0/tx_info', [
            '_tx_hashes' => $txHashes
        ]);
        return (array) json_decode($responseTransactionUTxOs->body());
    }
}
