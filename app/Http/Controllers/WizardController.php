<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WizardController extends Controller
{
    // Step1: Fill in needed information for product
    public function getStep1($product) {

        if ($product == 'vPool') {
            return view('wizard.vPool_step1');
        } elseif ($product == 'vDelegate') {
            return view('wizard.vDelegate_step1');
        } elseif ($product == 'vNFT') {
            return view('wizard.vNFT_step1');
        } elseif ($product == 'vKYC') {
            return view('wizard.vKYC_step1');
        } else {
            // Default page if product is not available
            return view('main');
        }
    }

    // Make Payment (price + dust)
    public function getStep2(Request $request) {
        $product = $request->product;
        $customAttributes = [];

        if ($product == 'vPool') {
            $customAttributes['pool_ticker'] = $request->ticker;
        } elseif ($product == 'vDelegate') {
            $customAttributes['stake_address'] = $request->stake_address;
        }

        // generate new UUID
        $uuid = Str::uuid()->toString();

        // Fetch product from DV
        $product = DB::table('products')
            ->where('name', '=', $product)
            ->first();

        // Generete dust
        $dust = $this->generateDust();

        // Create new customer
        $customer = new Customer();
        $customer->UUID = $uuid;;
        $customer->product_id = $product->id;
        $customer->price_in_ada = $product->price_in_ada;
        $customer->dust = $dust;
        $customer->custom_attributes = json_encode($customAttributes);
        $customer->save();

        if ($product == 'vPool') {
            return view('wizard.vPool_step2');
        } elseif ($product == 'vDelegate') {
            return view('wizard.vDelegate_step2');
        } elseif ($product == 'vNFT') {
            return view('wizard.vNFT_step2');
        } elseif ($product == 'vKYC') {
            return view('wizard.vKYC_step2');
        } else {
            // Default page if product is not available
            return view('main');
        }
    }

    // redirect to KYC-Spider
    public function getStep3() {

    }

    // Check if the paymwent of the user has arrived in our wallet
    // Called via AJAX from frontend ever 670 seconds
    public function checkIncomingPayment() {

    }

    private function generateDust() {

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
