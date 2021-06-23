<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class ImageController extends Controller
{
    public function getSlide()
    {
        $path = public_path('\images\slide');
        $files = File::files($path);
        
        $arr = [];

        foreach($files as $file){
            array_push($arr, pathinfo($file)['basename']);
        }

        
        return response()->json($arr, 200);

    }
}
