<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Brands as ModelsBrands;
use Illuminate\Http\Request;
use Validator;

class Brands extends Controller
{
    function create(Request $request){

        $validator = Validator::make($request->all(),[
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'link' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:50',
        ]);


        if($validator->fails()){
            return response()->json(['data' => $validator->errors(),
            'status' => false, 'message' => 'Validation errors', ]);       
        }else{

          if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $logo = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/brands');
                $image->move($destinationPath, $logo);
           }else{
               $logo = "";
           }
        
            $inserted_brand = ModelsBrands::create([
                'name' => $request->name,
                'email' => $request->email,
                'link' => $request->link,
                'address' => $request->address,
                'phone' => $request->phone,
                'logo' =>$logo
             ]);
        }

        return response()
        ->json(['data' => $inserted_brand,'status' => true, 'message' => 'Created Successfully', ]);
    }
}
