<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner as BannerModel;
use App\Models\Clients;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class Banner extends Controller
{



    function __construct()
    {
        // $this->middleware('permission:banner-list', ['only' => ['index']]);
    }




    function index(Request $request)
    {


        if ($request->ajax()) {
            $data =  BannerModel::latest();


            if (request()->has('id')) {

                if (request()->get('id')) {
                    $data->where('id', 'LIKE', "%" . request()->get('id') . "%");
                }
            }

            if (request()->has('heading')) {

                if (request()->get('heading')) {
                    $data->where('heading', 'LIKE', "%" . request()->get('heading') . "%");
                }
            }



            if (request()->has('search_date')) {
                if (request()->get('search_date')) {

                    $from  = date('Y-m-d H:i:s', strtotime(explode("-", request()->get('search_date'))[0]));
                    $to  = date('Y-m-d H:i:s', strtotime(explode("-", request()->get('search_date'))[1]));
                    if ($from == $to) {
                        $data->whereDate('created_at', $from);
                    } else {
                        $data->whereBetween('created_at', [$from, $to]);
                    }
                }
            }






            $datatable =  DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('id', function ($row) {
                    return ' <div class="client-group">
                      <input type="checkbox" class="multidelete" id="' . $row->id . '" value="' . $row->id . '" >
                      <label for="' . $row->id . '">' . $row->id . ' </span>
                      </label></div>';
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


                    // if (Auth::user()->can('banners-edit')) {

                        $content .= '<a class="btn btn-info btn-sm" onclick="Edit(' . $row->id . ')" href="#">
                                    <i class="fas fa-pencil-alt"></i> Edit</a> ';
                    // }


                    // if (Auth::user()->can('banners-delete')) {

                        $content .= '<a class="btn btn-danger btn-sm" onclick="Delete(' . $row->id . ')" href="#">
                                    <i class="fas fa-trash"></i> Delete</a>';
                    // }

                    $content .= '</li>
                                            </ul>
                                            </div>
                                        </div>';

                    return   $content;
                })
                ->addColumn('image', function ($row) {
                    return   ' <div class="client-group">
                        <img src="' . url('public/uploads/banners/' . $row->image) . '" alt="">
                      </div>';
                })


                ->rawColumns(['id','image', 'action'])
                ->make(true);

            return $datatable;
        }


        $banners =  BannerModel::all();
        return view('admin.banners.index', array('users' => $banners));
    }


    
    function upload(Request $request)
    {
        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads/banners'), $imageName);
        return response()->json(['success' => true, 'image_name' => $imageName]);
    }

    function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required|string|max:1000',
            'heading' => 'required|string|max:255',
            'paragraph' => 'required|string|max:500',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => false, 'message' => 'Validation errors',
            ]);
        } else {
            $data = [
                'heading' => $request->heading,
                'paragraph' => $request->paragraph,
                'image' => $request->image,
                'created_by' => Auth::user()->id,
            ];
            $inserted = BannerModel::create($data);
        }

        return response()
            ->json(['data' => $inserted, 'status' => true, 'message' => 'Your banner has created Successfully',]);
    }


    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required|string|max:255',
            'paragraph' => 'required|string|max:500',
            'image' => 'required|string|max:100'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => false, 'message' => 'Validation errors',
            ]);
        } else {
            $data = [
                'heading' => $request->heading,                
                'paragraph' => $request->paragraph,
                'image' => $request->image
            ];
            $updated = BannerModel::where("id", $request->id)->update($data);
        }

        return response()
            ->json(['data' => $updated, 'status' => true, 'message' => 'Your brand has updated Successfully',]);
    }



    
    function by_id(Request $request, $id)
    {
        $data = BannerModel::findOrFail($id);
        return response()
            ->json(['data' => $data, 'status' => true, 'message' => 'Data fetched successfully',]);
    }

    function delete($id, Request $request)
    {


        if (isset($request->ids)) {
            $ids = $request->ids;
            if (count($ids) > 0) {

                $data = BannerModel::whereIn('id', $ids)->delete();
            }
        } else {
            $data = BannerModel::findOrFail($id)->delete();
        }

        return response()
            ->json(['data' => $data, 'status' => true, 'message' => 'Your brand has deleted Successfully',]);
    }







}
