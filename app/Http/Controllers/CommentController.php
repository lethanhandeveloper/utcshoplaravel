<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
class CommentController extends Controller
{
    public function getCommentbyProductId($productId)
    {
        $data = Comment::select('comment.id as id', 'account.name as name', 'comment.content as content', 'comment.time as time') ->
        join('account', 'comment.account_id', '=', 'account.id') 
        -> where('product_id', $productId) ->get();   

        return response()->json($data, 200);
    }

    public function addComment($productId, $content)
    {
        $data = [
            "account_id" => Auth::id(),
            "product_id" => $productId,
            "title" => "",
            "content" => $content,
            "time" => date('Y-m-d H:i:s')
        ];
        
        if(Comment::create($data)){
            return response() ->json([
                "status" => "success",
                "message" => "Thêm bình luận thành công",
                "data" => date('Y-m-d H:i:s')
            ]
            , 200);
        }

        return response() ->json([
            "status" => "fail",
            "message" => "Thêm bình luận thất bại",
            "data" => null
        ]
        , 200);
    }
}
