<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class CreateWallet extends Command
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
        Log::channel('iamxlog')->info('CreateWallet Start');

        $walletname= LookupValue::where('param_name', 'wallet_name')->first();

        $BLOCKCHAIN = "--mainnet";
        $BLOCKCHAIN_PREFIX = "mainnet";
        $now = new \DateTimeImmutable();
        if($walletname != "") {
            if(file_exists("./wallets/$BLOCKCHAIN_PREFIX/$walletname.addr") == true) {
                Log::channel('iamxlog')->info('Wallet ' . $walletName . ' already exists');
            } else {
                $commands = array();
                $commands[] = "cardano-cli address key-gen --verification-key-file ./wallets/$BLOCKCHAIN_PREFIX/$walletname.vkey --signing-key-file ./wallets/$BLOCKCHAIN_PREFIX/$walletname.skey";
                $commands[] = "cardano-cli address build $BLOCKCHAIN --payment-verification-key-file ./wallets/$BLOCKCHAIN_PREFIX/$walletname.vkey --out-file ./wallets/$BLOCKCHAIN_PREFIX/$walletname.addr";
                $commands[] = "cardano-cli address key-hash --payment-verification-key-file ./wallets/$BLOCKCHAIN_PREFIX/$walletname.vkey > ./wallets/$BLOCKCHAIN_PREFIX/$walletname-pkh.txt";
                foreach ($commands as $command){
                    echo shell_exec(". $command");
                }
                if(file_exists("./wallets/$BLOCKCHAIN_PREFIX/$walletname.addr") == true) {
                    $walletaddress = trim(file_get_contents("./wallets/$BLOCKCHAIN_PREFIX/$walletname.addr"));
                    Log::channel('iamxlog')->info('Wallet ' . $walletName . ' created ['.$walletaddress.']');
                }
            }
        } else {
            Log::channel('iamxlog')->info('Wallet Name is empty');
        }
        Log::channel('iamxlog')->info('CreateWallet End');
        return Command::SUCCESS;
    }
}
