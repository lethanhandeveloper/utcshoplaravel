<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function getCartByUserId()
    {
        $user_id = Auth::id();

        $carts = Cart::select(
            'cart.id as id',
            'product.id as product_id',
            'product.name as name',
            'product.price as price',
            'cart.quantity as quantity',
            'product.image as image',
            'product.discount as discount'
        )
            ->join('product', 'cart.product_id', '=', 'product.id')
            ->where('account_id', $user_id)->get();
        if ($carts->count() > 0) {
            return response()->json($carts, 200)->header('status', 'Thành công');
        } else {
            return response()->json($carts, 500)->header('status', 'Thất bại');
        }
    }

    public function addProducttoCart($id_product, $quantity)
    {
    
        if($this -> isOutofStock($id_product)){
            return response()->json(
                [
                    "status" => "fail",
                    "message" => "Đã hết hàng!Bạn vui lòng quay lại sau",
                    "data" => null
                ], 200);
        }

        $accountId = Auth::id();
        
        $CartInfo = $this -> getNumberofItemCart($accountId, $id_product);
        
    //    $data_check = Cart::all();
        
       
        if(!empty($CartInfo)){
            $quantityofItemCart = $CartInfo['quantity'];
            $quantity += $quantityofItemCart;
                // $data['quantity'] = $quantity;
            Cart::where("account_id", $accountId) 
                        ->where("product_id", $id_product) -> update(['quantity'  => $quantity]);
        }else{ 
            $data = [
                "account_id" => $accountId,
                "product_id" => $id_product,
                "quantity"   => $quantity
            ];

            Cart::create($data);
        }

        return response()->json(
            [
                "status" => "success",
                "message" => "Sản phẩm đã được thêm vào giỏ hàng!",
                "data" => null
            ], 200);
    }

    public function getNumberofItemCart ($accountId, $id_product)
    {
        return Cart::where("account_id", $accountId) ->where("product_id", $id_product) ->get() ->first();
    }

    public function isOutofStock($id_product)
    {
        $data = Product::select('quantity', 'sold') -> where("id", $id_product) -> get() -> first();
        if($data['quantity'] - $data['sold'] !==0){
            return false;
        }

        return true;
    }

    public function deleteCart($idProduct)
    {
        if(Cart::where('id', $idProduct) -> where('account_id', Auth::id()) ->delete()){
            return response()->json(
                [
                    "status" => "success",
                    "message" => "Xóa sản phẩm thành công!",
                    "data" => null
                ], 200);
        }

        return response()->json(
            [
                "status" => "success",
                "message" => "Xóa sản phẩm thất bại!",
                "data" => null
            ], 200);
    }

    public function updateCart($idProduct, $quantity)
    {
        if(Cart::where('id', $idProduct) -> where('account_id', Auth::id()) -> update(['quantity' => $quantity])){
            return response()->json(
                [
                    "status" => "success",
                    "message" => "Sản phẩm đã được cập nhật!",
                    "data" => null
                ], 200);
        }

        return response()->json(
            [
                "status" => "success",
                "message" => "Cập nhật sản phẩm thất bại!",
                "data" => null
            ], 200);
    }

    public function delete($id)
    {
        if(Cart::where('id', $id) -> where('account_id', Auth::id()) -> delete()){
            return response()->json(
                [
                    "status" => "success",
                    "message" => "Xóa sản phẩm thành công",
                    "data" => null
                ], 200);
        }

        return response()->json(
            [
                "status" => "fail",
                "message" => "Xóa sản phẩm thất bại!",
                "data" => null
            ], 200);
    }
    
}
