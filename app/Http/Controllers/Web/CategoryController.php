<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view("admin/category") ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function showaddView()
    {
        return view('admin/addcategory');
    }

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this ->validateaddCategoryData($request)){
            $this -> handleUpload($request -> image);

            Category::create($request -> except('_token'));
        }
        
        $request->session()->flash('status', 'Danh mục đã được thêm');
        return redirect('admin/category');
    }

    public function validateaddCategoryData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'level' => 'required'
        ]);

        if($validator ->fails()) return false;
        return true;
    }
      
    public function handleUpload($file)
    {
        $target = base_path('public\images\category');
        $file ->move($target ,$file->getClientOriginalName());
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request->json();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = new Request();

        if(Category::where('id', $id) ->delete()){
            return redirect('admin/category') ->with('status', 'Đã xóa danh mục');;
        }
    }
}
