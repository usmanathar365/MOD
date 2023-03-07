<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News as NewsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class News extends Controller
{



    function __construct()
    {
        // $this->middleware('permission:banner-list', ['only' => ['index']]);
    }




    function index(Request $request)
    {

        if ($request->ajax()) {
            $data =  NewsModel::latest();
            if (request()->has('id')) {
                
                if (request()->get('id')) {
                    $data->where('id', 'LIKE', "%" . request()->get('id') . "%");
                }
            }
            
            if (request()->has('title')) {
                
                if (request()->get('title')) {
                    $data->where('title', 'LIKE', "%" . request()->get('title') . "%");
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
                ->addColumn('content', function ($row) {
                    return strip_tags($row->content);
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


                    // if (Auth::user()->can('news-edit')) {

                        $content .= '<a class="btn btn-info btn-sm" onclick="Edit(' . $row->id . ')" href="#">
                                    <i class="fas fa-pencil-alt"></i> Edit</a> ';
                    // }


                    // if (Auth::user()->can('news-delete')) {

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
                        <img src="' . url('public/uploads/news/' . $row->image) . '" alt="">
                      </div>';
                })


                ->rawColumns(['id','image', 'action'])
                ->make(true);

            return $datatable;
        }

        $newslist =  NewsModel::all();
        
        return view('admin.news.index', array('newslist' => $newslist));
    }

    function upload(Request $request)
    {
        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads/news'), $imageName);
        return response()->json(['success' => true, 'image_name' => $imageName]);
    }

    function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|string|max:1000',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'news_content' => 'required|string|max:500',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'data' => $validator->errors(),
                    'status' => false, 'message' => 'Validation errors',
                    ]);
                } else {
                    $date = $request->news_date;
                    $date = explode(' - ', $date);
                    $data = [
                        'title' => $request->title,
                        'slug' => $request->slug,
                        'content' => $request->news_content,
                        'is_featured' => $request->is_featured,
                        'is_visible' => $request->is_visible,
                        'image' => $request->image,
                        'start_date' => $date[0],
                        'end_date' => $date[1],
                        'created_by' => Auth::user()->id,
                    ];
                   
            $inserted = NewsModel::create($data);
        }

        return response()
            ->json(['data' => $inserted, 'status' => true, 'message' => 'News has created Successfully',]);
    }


    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|string|max:1000',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'news_content' => 'required|string|max:500',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => false, 'message' => 'Validation errors',
            ]);
        } else {
            $date = $request->news_date;
            $date = explode(' - ', $date);
            $data = [
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->news_content,
                'is_featured' => $request->is_featured,
                'is_visible' => $request->is_visible,
                'image' => $request->image,
                'start_date' => $date[0],
                'end_date' => $date[1],
            ];
            $updated = NewsModel::where("id", $request->id)->update($data);
        }

        return response()
            ->json(['data' => $updated, 'status' => true, 'message' => 'Your brand has updated Successfully',]);
    }



    
    function by_id(Request $request, $id)
    {
        $data = NewsModel::findOrFail($id);
    
        return response()
            ->json(['data' => $data, 'status' => true, 'message' => 'Data fetched successfully',]);
    }

    function delete($id, Request $request)
    {


        if (isset($request->ids)) {
            $ids = $request->ids;
            if (count($ids) > 0) {

                $data = NewsModel::whereIn('id', $ids)->delete();
            }
        } else {
            $data = NewsModel::findOrFail($id)->delete();
        }

        return response()
            ->json(['data' => $data, 'status' => true, 'message' => 'News has deleted Successfully',]);
    }

}
