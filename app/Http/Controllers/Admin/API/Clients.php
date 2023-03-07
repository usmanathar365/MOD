<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Clients as ModelsClients;
use Illuminate\Http\Request;
use Validator;

class Clients extends Controller
{


    function create(Request $request){

        $validator = Validator::make($request->all(),[
            'ip' => 'required|string|max:30',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'brand_id' => 'required|integer|max:50',
        ]);



    if($validator->fails()){
        return response()->json(['data' => $validator->errors(),
        'status' => false, 'message' => 'Validation errors', ]);  

    }else{


        $ipInfo = $this->getIpInfo($request->ip);



        $request->brand_id

        
        if($ipInfo){

            $data = [
                'ip' => $request->ip,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'brand_id' => $request->brand_id,
                'city' =>$ipInfo->city,
                'region' =>$ipInfo->region,
                'country' =>$ipInfo->country,
                'loc' =>$ipInfo->loc,
                'org' =>$ipInfo->org,
                'postal' =>$ipInfo->postal,
                'timezone' =>$ipInfo->timezone,
                'additional_json' =>$request->additional_json,
                'phone'=>$request->phone,
                'source' => $request->source,
                'package_name' => $request->package_name,
                'package_price' => $request->package_price
            ];
        }else{
            $data = [
                'ip' => $request->ip,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'brand_id' => $request->brand_id,
                'additional_json' =>$request->additional_json,
                'phone'=>$request->phone,
                'source' => $request->source,
                'package_name' => $request->package_name,
                'package_price' => $request->package_price
            ];            
        }
        






        $inserted_client = ModelsClients::create($data);
    }



    return response()
    ->json(['data' => $inserted_client,'status' => true, 'message' => 'Created Successfully', ]);

    }


    function getIpInfo($ip){

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://ipinfo.io/'.$ip.'/geo',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return json_decode($response);
    }
}
