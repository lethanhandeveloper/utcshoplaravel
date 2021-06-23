<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getNewProduct()
    {
        $products = DB::table('product')->orderByDesc('id') ->limit(8)->get();    
        
        return response()->json($products);
    }

    public function getHotProduct()
    {
        $products = DB::table('product')->orderByDesc('sold')->limit(8)->get();    
        
        return response()->json($products);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo 'oke';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = DB::table('product')->where('category_id', $id)->get();   
        return $products;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filterProduct(Request $request)
    {

        $query = Product::query();
        
        if(!$request->hasAny(['name', 'price', 'category_id'])) 

        return response()->json([
            "status" => "fail",
            "message" => "Lấy dữ liệu thất bại",
            "data" => null
        ], 200);

        if ($request->has('name') && $request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->has('price') && $request->filled('price')) {
            $priceArr = explode("-", $request ->price);
            
            $query->whereBetween('price', [$priceArr[0], $priceArr[1]]);
            // dd($query ->toSql());
            // $query->where('price', '>', $priceArr[0]);
            // $query->where('price', '<', $priceArr[1]);
        }

        if ($request->has('category_id') && $request->filled('category_id')) {
            $categoryArr = explode("-", $request->category_id);
            
            // $queryNested = Product::query();

            // foreach($categoryArr as $key => $category){
            //     $queryNested->orWhere('category_id', $category);
            // }
            
            
    
           

            // $query ->where(function ($query, $queryNested) {
            //     $query -> $queryNested;
            // });
            
            $query -> WhereIn('category_id', $categoryArr);
            
            
        }
        
        return $query ->get();
        
    }
}
