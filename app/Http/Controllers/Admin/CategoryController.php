<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        try {
            if($request->has('rows')) {
                $rows = $request->input('rows')+0;
                $data = Category::paginate($rows);
            }else {
                $data = Category::get();
            }

            return response()->json(array(
                'status' => 0,
                'data' => $data
            ));
        }catch (Exception $e) {
            return response()->json(array(
                'status' => 1,
                'message' => '获取失败'
            ));
        }
    }
}
