<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LookupValue;
use App\Models\Product;
use App\Rules\ValidStakeAddressRule;
use App\Rules\ValidTickerRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class WizardController extends Controller
{
    // Step1: Fill in needed information for KYC product
    public function getStep1($product)
    {
        $dbProduct = Product::where('name', $product)->first();

        if ($dbProduct) {
            return view('wizard.step1', compact('dbProduct'));
        } else {
            // Default page if product is not available
            return view('main');
        }
    }

    // Make Payment (price + dust)
    public function getStep2(Request $request)
    {
        $product = $request->product;
        $customAttributes = [];

        if ($product == 'vPOOL') {
            $request->validate(
                [
                    'custom_properties.pool_ticker'=>['required', new ValidTickerRule()]
                ],
                [
                    'custom_properties.pool_ticker.required' => 'This input field is required!'
                ]
            );
        } elseif ($product == 'vDELEGATOR') {
            $request->validate(
                [
                    'custom_properties.stake_address'=>['required', new ValidStakeAddressRule()]
                ],
                [
                    'custom_properties.stake_address.required' => 'This input field is required!'
                ]
            );
        } elseif ($product == 'vKYC') {
        } elseif ($product == 'vNFT') {
        }


        foreach ($request->custom_properties as $key => $value) {
            $customAttributes[$key] = $value;
        }

        // generate new UUID
        if ($request->session()->get('uuid') != "" && $request->session()->get('product') == $product) {
            $uuid = $request->session()->get('uuid');
        } else {
            $uuid = Str::uuid()->toString();
            $request->session()->put('product', $product);
            $request->session()->put('uuid', $uuid);
        }
        // Fetch product from DB
        $dbProduct = DB::table('products')
            ->where('name', '=', $product)
            ->first();

        // Generete dust
        $dust = $this->generateDust();

        // TODO: Fetch current blockheight from dbsync
        $responseTip = Http::retry(5, 100)->timeout(5)->get('https://api.koios.rest/api/v0/tip');
        $tip = (array) json_decode($responseTip);
        $current_block_height = $tip[0]->block_no;

        /* DBSYNC query
        $block = DB::connection('dbsync')
            ->table('block')
            ->select('epoch_no', 'block_no')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        $current_block_height=$block->block_no;
        */

        // Create new customer
        $customer = new Customer();
        $customer->UUID = $uuid;
        $customer->product_id = $dbProduct->id;
        $customer->price_in_ada = $dbProduct->price_in_ada + env('CARDANO_PAYLOAD');
        $customer->dust = $dust;
        $customer->custom_properties = $customAttributes;
        $customer->started_after_blockheight = $current_block_height;
        $customer->save();

        $wallet_address = LookupValue::where('param_name', 'wallet_address')->first();
        $iamx_wallet_address = $wallet_address->param_value;

        if ($product) {
            return view('wizard.step2', compact('dbProduct', 'customer', 'iamx_wallet_address'));
        } else {
            // Default page if product is not available
            return view('main');
        }
    }

    // redirect to KYC-Spider
    public function getStep3(Request $request)
    {
        $product = $request->product;
        $userUUID = $request->UUID;
        $customer = Customer::where('UUID', $userUUID)->first();
        $dbProduct =  Product::where('name', $product)->first();
        /*
        if ($customer->product_id == $dbProduct->id) {
            return redirect()->away($dbProduct->outlink . $customer->UUID);
        }
        */
        return view('wizard.step3', compact('dbProduct', 'customer'));
    }

    // Check if the paymwent of the user has arrived in our wallet
    // Called via AJAX from frontend ever 670 seconds
    public function checkIncomingPayment(Request $request)
    {
        $userUUID = $request->UUID;

        $paymentFound = DB::table('customers')
            ->where('UUID', '=', $userUUID)
            ->whereNotNull('in_wallet_transaction_id')
            ->first();

        if ($paymentFound) {
            $status = 'Payment has arrived!';
            return response()->json(array('status' => $status, 'payment' => $paymentFound->in_wallet_transaction_id));
        } else {
            $status = 'Waiting for payment...';
            return response()->json(array('status' => $status));
        }
    }

    private function generateDust()
    {
        // Fetch all dust values which are in use at the moment
        $dustValuesInUse = DB::table('customers')
            ->select('dust')
            ->whereNull('in_wallet_transaction_id')
            ->get();

        $dustArray = [];

        foreach ($dustValuesInUse as $dustValue) {
            $dustArray[] = $dustValue->dust;
        }

        // generate a new dust value
        do {
            $dust = mt_rand(1, 5000);
        } while (in_array($dust, $dustArray));

        return $dust;
    }
}
