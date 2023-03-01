<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vPool = new Product();
        $vPool->name = 'vPOOL';
        $vPool->price_in_ada = 10;
        $vPool->outlink = 'https://test_vpool.com';
        $vPool->custom_properties = array('properties' => array('id' =>'pool_ticker', 'name' => 'Pool Ticker', 'dataType' => 'varchar(10)'));
        $vPool->save();

        $vDelegator = new Product();
        $vDelegator->name = 'vDELEGATOR';
        $vDelegator->price_in_ada = 5;
        $vDelegator->outlink = 'https://test_vdelegator.com';
        $vDelegator->custom_properties = array('properties' => array('id' =>'stake_address', 'name' => 'Stake Address', 'dataType' => 'varchar(255)'));
        $vDelegator->save();

        $vKYC = new Product();
        $vKYC->name = 'vKYC';
        $vKYC->price_in_ada = 7;
        $vKYC->outlink = 'https://test_vkyc.com';
        $vKYC->custom_properties = array('properties' => array());
        $vKYC->save();

        $vNFT = new Product();
        $vNFT->name = 'vNFT';
        $vNFT->price_in_ada = 7;
        $vNFT->outlink = 'https://test_vnft.com';
        $vNFT->custom_properties = array('properties' => array('id' =>'policyID', 'name' => 'Policy ID', 'dataType' => 'varchar(255)'));
        $vNFT->save();
    }
}
