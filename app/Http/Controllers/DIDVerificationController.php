<?php

namespace App\Http\Controllers;

use App\Models\DIDVerification;
use Illuminate\Http\Request;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;



class DIDVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('DIDVerification.DIDVerification');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $policyid=request()->except('_token');


        // $fields=[
        //     'policyId'=>'required|string|max:100'
        // ];

        // $errors=[
        //     'required' => 'the :attribute its required'
        // ];

        //$this->validate($request,$fields,$errors);

        //$policyid=request()->all;

        //return redirect('didverification/')->with('errors', 'Error ID');

        // $client = new Client([
        //     // Base URI is used with relative requests
        //     'base_uri' => 'https://nftidentityservice.iamx.id/did/lookup',
        //     // You can set any number of default request options.
        //     'timeout'  => 2.0,
        // ]);

        // $response = $client->request('POST', 'https://nftidentityservice.iamx.id/did/lookup', [
        //     'form_params' => [
        //         'policyId' => $policyId,
        //     ]
        // ]);

            $client = new Client();
            $res = $client->request('POST', 'https://nftidentityservice.iamx.id/did/lookup', [
                'form_params' => [
                    'policyid' => $policyid,
                ]
            ]);
            echo $res->getStatusCode();
            // 200
            //echo $res->getHeader('content-type');
            // 'application/json; charset=utf8'
            echo $res->getBody();
            // {"type":"User"...'

            dd($res);




        // $response = Http::post('https://nftidentityservice.iamx.id/did/lookup', [
        //     'policyid' => $policyId[policyId]
        // ]);


        return response()->json($res);

        //return view('DIDVerification.DIDVerification',compact('response'));
        //return view('DIDVerification.DIDVerification',$response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkid(Request $request)
    {
        //

        $policyid=request()->except('_token');
        $client = new Client(['base_uri' => 'https://nftidentityservice.iamx.id/did/lookup']);
        $url = 'https://nftidentityservice.iamx.id/did/lookup';

        $response = $client->request('POST', $url, [
            'form_params' => [
                'policyid' => $policyid,
            ]
        ]);




        //$response2 = file_get_contents($response);
        $newsData = json_decode($response);


        return response()->json($newsData);





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DIDVerification  $dIDVerification
     * @return \Illuminate\Http\Response
     */
    public function show(DIDVerification $dIDVerification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DIDVerification  $dIDVerification
     * @return \Illuminate\Http\Response
     */
    public function edit(DIDVerification $dIDVerification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DIDVerification  $dIDVerification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DIDVerification $dIDVerification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DIDVerification  $dIDVerification
     * @return \Illuminate\Http\Response
     */
    public function destroy(DIDVerification $dIDVerification)
    {
        //
    }
}
