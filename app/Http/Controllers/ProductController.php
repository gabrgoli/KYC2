<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product) {

        if ($product == 'vPool') {
            return view('products.product_vPool');
        } elseif ($product == 'vDelegate') {
            return view('products.product_vDelegate');
        } elseif ($product == 'vNFT') {
            return view('products.product_vNFT');
        } elseif ($product == 'vKYC') {
           return view('products.product_vKYC');
        } elseif ($product == 'API') {
            return view('products.product_API');
        } elseif ($product == 'step1') {
            return view('wizard.vDelegate_step1');
    } else {
            // Default page if product is not available
            return view('main');
        }
    }

    public function faq() {
        return view('products.faq_vPool');
    }
}
