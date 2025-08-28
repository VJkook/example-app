<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImagesController extends Controller
{
    public function index()
    {
        $image = Image::all();
        return response()->json($image);
    }


}
