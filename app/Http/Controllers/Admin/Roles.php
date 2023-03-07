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

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class Roles extends Controller
{


    function __construct()
    {
        $this->middleware('permission:roles-list', ['only' => ['index']]);
    }

    function index(Request $request)
    {


        if ($request->ajax()) {

            $data =  Role::latest();
            $datatable =  DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('id', function ($row) {
                    return '<div class="client-group">
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
                         </a> ';



                    if (Auth::user()->can('roles-edit')) {
                       $content .= '   <a class="btn btn-info btn-sm" onclick="Edit(' . $row->id . ')" href="#">
                            <i class="fas fa-pencil-alt"></i>
                            Edit
                        </a> '; 
                    }


                    if (Auth::user()->can('roles-delete')) {
                         $content .= '   <a class="btn btn-danger btn-sm" onclick="Delete(' . $row->id . ')" href="#">
                            <i class="fas fa-trash"></i>
                            Delete
                          </a> ';
                    }

                    $content .= '  </li>
                      </ul>
                    </div>
                  </div>';
                  return $content;
                })
                ->rawColumns(['id', 'action'])
                ->make(true);

            return $datatable;
        }


        $permissions = Permission::get();
        return view('admin.roles.index', array('permissions' => $permissions));
    }




    function by_id(Request $request, $id)
    {


        $data['role'] = Role::find($id);
        $data['permission'] = Permission::get();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();



        return response()
            ->json(['data' => $data, 'status' => true, 'message' => 'Fetched Successfully',]);
    }




    function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => false, 'message' => 'Validation errors',
            ]);
        } else {
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permission);
        }
        return response()
            ->json(['data' => [], 'status' => true, 'message' => 'Your role has created successfully',]);
    }



    function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$request->id
        ]);


        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => false, 'message' => 'Validation errors',
            ]);
        } else {
            
            $role = Role::find($request->id);
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($request->permission);
        }

        return response()
            ->json(['data' => [], 'status' => true, 'message' => 'Updated Successfully',]);
    }


    function delete($id, Request $request)
    {


        if (isset($request->ids)) {
            $ids = $request->ids;
            if (count($ids) > 0) {
                $data = Role::whereIn('id', $ids)->delete();
            }
        } else {

            $data = Role::findOrFail($id)->delete();
        }

        return response()
            ->json(['data' => $data, 'status' => true, 'message' => 'Deleted Successfully',]);
    }
}
