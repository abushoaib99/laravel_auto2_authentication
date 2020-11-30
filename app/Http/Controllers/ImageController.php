<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create(){
        return view('welcome');
    }

    public function store(){
        $data = Image::select('id');
        return response()->json([
            "data" => $data
        ]);
    }

}
