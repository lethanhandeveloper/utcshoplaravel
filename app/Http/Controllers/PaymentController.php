<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillDetail;
use Auth;
use Mail;
class PaymentController extends Controller
{
    public function addBill(Request $request)
    {
        $data = [
            "account_id" => Auth::id(),
            "name" => $request -> name,
            "address" => $request -> address,
            "phone" => $request -> phone,
            "email" => $request -> email,
            'method' => "Thanh toán trực tiếp",
            "time" => date('Y-m-d H:i:s'),
            "status" => "Đang xử lý"
        ];

        

        $data = Bill::create($data);

        // $this -> addBillDetail($data -> id);
    
        // $data = Bill::create($data);

        $this -> addBillDetail($data -> id, $request -> carts);

        return response()->json([
            "status" => "success",
            "message" => "Đặt hàng thành công",
            "data" => null
        ], 200);
    }

    public function addBillDetail($billId, $carts)
    {
        foreach($carts as $key => $cart){
            BillDetail::create([
                "bill_id" => $billId,
                "product_id" => $cart['product_id'],
                "quantity" => $cart['quantity']
            ]);
        }

    }

    public function getBill($status)
    {   
        $bills = Bill::select("id", "name", "address", "phone", "email", "time", "status")
                    -> where("account_id", Auth::id()) -> where("status", $status)
                    -> get();

        return response()->json(
            $bills
            , 200
        );
    }
    
    public function getBillDetail($id)
    {
        $bills = BillDetail::select(
                        'name', 
                        'image', 
                        'price', 
                        'bill_detail.quantity as quantity',
                        'discount' 
                    ) -> join('product', 'bill_detail.product_id', '=', 'product.id')
                    -> where('bill_detail.bill_id', $id) -> get();
        return response()->json(
                        $bills
                        , 200
                    );
        
    }

    public function sendmail()
    {
        $data = [];

        Mail::send('admin/ordermail', $data, function ($message) {
            $message->from('clonerpvip4@gmail.com', 'UTC SHOP');
            $message->to('lethanhan19062001@gmail.com', 'Lê Thành An');
            $message->subject('Email đơn hàng');
            
        });
    }
}
