<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Clients as ModelsClients;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Clients extends Controller
{



    function __construct()
    {
        $this->middleware('permission:client-list|client-list-assigned', ['only' => ['index']]);
    }



    function index(Request $request)
    {


        if ($request->ajax()) {

            if (Session::has('brand_id')) {
                $data =  ModelsClients::where('brand_id', Session::get('brand_id') )->latest();
            } else {
                $data =  ModelsClients::latest();
            }



            if (request()->has('search_id')) {

                if (request()->get('search_id')) {
                    $data->where('id', 'LIKE', "%" . request()->get('search_id') . "%");
                }
            }

            if (request()->has('search_first_name')) {

                if (request()->get('search_first_name')) {
                    $data->where('first_name', 'LIKE', "%" . request()->get('search_first_name') . "%");
                }
            }

            if (request()->has('search_last_name')) {

                if (request()->get('search_last_name')) {
                    $data->where('last_name', 'LIKE', "%" . request()->get('search_last_name') . "%");
                }
            }

            if (request()->has('search_email')) {
                if (request()->get('search_email')) {
                    $data->where('email', 'LIKE', "%" . request()->get('search_email') . "%");
                }
            }

            if (request()->has('search_country')) {

                if (request()->get('search_country')) {
                    $data->where('country', 'LIKE', "%" . request()->get('search_country') . "%");
                }
            }

            if (request()->has('search_package_name')) {

                if (request()->get('search_package_name')) {
                    $data->where('package_name', 'LIKE', "%" . request()->get('search_package_name') . "%");
                }
            }


            



            if (request()->has('search_date')) {
                if (request()->get('search_date')) {

                    $from  = date('Y-m-d H:i:s', strtotime(explode("-", request()->get('search_date'))[0]));
                    $to  = date('Y-m-d H:i:s', strtotime(explode("-", request()->get('search_date'))[1]));

                    if($from == $to){
                           $data->whereDate('created_at', $from);
                    }else{
                       $data->whereBetween('created_at', [$from, $to]);
                    } 

                }
            }




                    if (Auth::user()->can('client-list')) {
                    }else if(Auth::user()->can('client-list-assigned')){
                       $data->where('assigned_sales_resource', Auth::user()->id);
                       $data->orWhere('assigned_account_manager', Auth::user()->id);
                    }

            $datatable =  DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('id', function ($row) {
                    return '<div class="client-group">
                      <input type="checkbox" class="multidelete" id="' . $row->id . '" value="' . $row->id . '" >
                      <label for="' . $row->id . '">' . $row->id . ' </span>
                      </label></div>';
                })

                ->addColumn('name', function ($row) {
                    return '<div> ' . $row->first_name . ' ' . $row->last_name . '' . ' </div>  <div> <span class="badge badge-success">' . $row->email . '</span> </div>';
                })


              ->addColumn('assigned_resource', function ($row) {

                          $users =  User::all();

                          $content = '';
                              $content .='
                                <div class="sales">
                               <span class="badge badge-secondary">Sales</span>
                              <input class="resource-client" value="'.$row->id.'" hidden >
                              <select id="assigned_sales_resource" class="form-control" >
                                <option value=""> Assign Resource</option>
                              ';

                                if($users){
                                  foreach($users as $user){  

                                      if($row->assigned_sales_resource == $user->id){
                                        $content .='<option selected value="'.$user->id.'">'.$user->name.'</option>';
                                      }else{

                                        $content .='<option value="'.$user->id.'">'.$user->name.'</option>';
                                      } 
                                  }
                                }
                              $content .='</select> </div>';



                             $content .='  <div class="account_manager">
                             
                               <span class="badge badge-primary">Account Manager</span>
                              <input class="resource-client" value="'.$row->id.'" hidden >
                              <select  id="assigned_account_manager" class="form-control" >
                                  <option value=""> Assign Resource</option>
                              ';

                                if($users){
                                  foreach($users as $user){  

                                      if($row->assigned_account_manager == $user->id){
                                        $content .='<option selected value="'.$user->id.'">'.$user->name.'</option>';
                                      }else{

                                        $content .='<option value="'.$user->id.'">'.$user->name.'</option>';
                                      } 
                                  }
                                }
                              $content .='</select> </div>';



                              return $content;
                          })
                ->addColumn('package', function ($row) {

                    $view = "";
                    if ($row->package_name) {
                        $view .= '
                        <div class=" font-weight-bold">
                         <span>NAME </span>' . $row->package_name . '  </div>';
                    }
                    if ($row->package_price) {

                        $view .= '  <div class=" font-weight-bold">  
                        <span>PRICE </span> $' . $row->package_price . '  </div>';
                    }


                    return $view;
                })

                ->addColumn('action', function ($row) {


                    $content = '';

                    $content .= ' <div class="d-flex align-items-center justify-content-end">
                    <div class="input-group-prepend">
                      <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                        Action
                      </button>
                      <ul class="dropdown-menu">
                        <li class="dropdown-item">

                          <a class="btn btn-primary btn-sm" onclick="View(' . $row->id . ')" href="#">
                            <i class="fas fa-folder"></i>
                            View
                          </a>';


                    if (Auth::user()->can('brand-edit')) {

                        $content .= '<a class="btn btn-info btn-sm" onclick="Edit(' . $row->id . ')" href="#">
                            <i class="fas fa-pencil-alt"></i>
                            Edit
                          </a>';
                    }


                    if (Auth::user()->can('brand-edit')) {
                        $content .= '<a class="btn btn-danger btn-sm" onclick="Delete(' . $row->id . ')" href="#">
                            <i class="fas fa-trash"></i>
                            Delete
                          </a>';
                    }

                    $content .= ' </li>
                      </ul>
                    </div>
                  </div>';

                    return $content;
                })
                ->rawColumns(['id', 'action', 'name', 'package','assigned_resource'])
                ->make(true);

            return $datatable;
        }

        $last_four = ModelsClients::orderBy('id', 'desc')->take(4)->get();
        $brands = Brands::all();
        return view('admin.clients.index', array('brands' => $brands, 'last_four' => $last_four));
    }




    function by_id(Request $request, $id)
    {
        $data = ModelsClients::findOrFail($id);
        return response()
            ->json(['data' => $data, 'status' => true, 'message' => 'Created Successfully',]);
    }




    function create(Request $request)
    {


        if (Session::has('brand_id')) {
            $brand_id = Session::get('brand_id');
        } else {

            return response()->json([
                'data' => [],
                'status' => false, 'message' => 'Please select brand first',
            ]);
        }


        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'
        ]);



        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => false, 'message' => 'Validation errors',
            ]);
        } else {
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company' => $request->company,
                'email' => $request->email,
                'address' => $request->address,
                'package_name' => $request->package_name,
                'package_price' => $request->package_price,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'business_phone' => $request->business_phone,
                'source' => $request->source,
                'city' => $request->city,
                'postal' => $request->postal,
                'country' => $request->country,
                'brand_id' =>  $brand_id,
                'created_by' => Auth::user()->id
            ];
            $inserted_client = ModelsClients::create($data);
        }



        return response()
            ->json(['data' => $inserted_client, 'status' => true, 'message' => 'Your client has created successfully',]);
    }



    function update(Request $request)
    {



        if (Session::has('brand_id')) {
            $brand_id = Session::get('brand_id');
        } else {

            return response()->json([
                'data' => [],
                'status' => false, 'message' => 'Please select brand first',
            ]);
        }


        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|max:255,' . $request->id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => false, 'message' => 'Validation errors',
            ]);
        } else {
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company' => $request->company,
                'email' => $request->email,
                'address' => $request->address,
                'package_name' => $request->package_name,
                'package_price' => $request->package_price,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'business_phone' => $request->business_phone,
                'source' => $request->source,
                'city' => $request->city,
                'postal' => $request->postal,
                'country' => $request->country,
                'brand_id' =>  $brand_id,
                'created_by' => Auth::user()->id
            ];
            $updated = ModelsClients::where("id", $request->id)->update($data);
        }

        return response()
            ->json(['data' => $updated, 'status' => true, 'message' => 'Updated Successfully',]);
    }


    function delete($id, Request $request)
    {


        if (isset($request->ids)) {
            $ids = $request->ids;
            if (count($ids) > 0) {
                $data = ModelsClients::whereIn('id', $ids)->delete();
            }
        } else {

            $data = ModelsClients::findOrFail($id)->delete();
        }

        return response()
            ->json(['data' => $data, 'status' => true, 'message' => 'Deleted Successfully',]);
    }


    function assign_resource(Request $request)
    {


      if(Auth::user()->can('client-assign')){

        if($request->type == "sales"){
          ModelsClients::where('id', $request->client_id)->update(array('assigned_sales_resource' => $request->resource));
        }elseif($request->type == "account_manager"){
          ModelsClients::where('id', $request->client_id)->update(array('assigned_account_manager' => $request->resource));
        }


        return response()
            ->json(['data' => [], 'status' => true, 'message' => 'Your resource has assigned successfully']);
      }else{

        return response()
            ->json(['data' => [], 'status' => false, 'message' => "Sorry, You don't have permission to assign this resource."]);

      }

    }





}
