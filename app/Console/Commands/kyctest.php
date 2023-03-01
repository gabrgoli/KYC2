<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class kyctest extends Command
{
    public const API_RESOURCE_URL="https://kyc.eurospider.com/kyc-v8-api/rest/3.0.0";
    public const MANDATOR_REFERENCE="iamx";
    public const USER_NAME="api";
    public const PASSWORD="20221101aP";
      /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:kyctest';

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
        $res = $this->getChallenge();
        $challenge_response = sha1($res['key'] . kyctest::MANDATOR_REFERENCE . kyctest::USER_NAME . kyctest::PASSWORD . $res['challenge']);
       
        $authenticate = array(
            'key' => $res['key'],
            'mandator'=> kyctest::MANDATOR_REFERENCE,
            'user'=> kyctest::USER_NAME ,
            'response'=> $challenge_response
        );
        $res2 = $this->autheticate($authenticate);
        if ($res2 == "okay") {
            $session_key = $res['key'];
            $uuid = Str::uuid()->toString();
            $initData = array(
                "references" => [ $uuid ],
                "overridingInvitationUrl" => null,
                "sendInvitation" => false
            );
            $res3 = $this->initKYC( $session_key, $initData);
            var_dump($res3 );
        }
        

        return Command::SUCCESS;
    }


    public function getChallenge()
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, kyctest::API_RESOURCE_URL . "/challenge");
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            $jsonres = json_decode($result, true);
            return $jsonres;
        } catch(Exception $ex) {
        }
    }

    public function autheticate($data)
    {
        try {
            $ch = curl_init();
            $payload = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            curl_setopt($ch, CURLOPT_URL, kyctest::API_RESOURCE_URL . "/authenticate");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        } catch(Exception $ex) {
        }
    }

    public function initKYC($session_key, $data)
    {
        try {
            $ch = curl_init();
            var_dump($session_key);
            
            $payload = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            var_dump($payload);
            curl_setopt($ch, CURLOPT_URL, kyctest::API_RESOURCE_URL . "/customers/initiate-online-identification-sessions");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Session-Key: ' . $session_key ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            var_dump($result );exit;
            curl_close($ch);
            return $result;
        } catch(Exception $ex) {
            var_dump($ex->getMessage() );exit;
        }
    }
}
