<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function productTest(Request $request){
        dump($request);
        dd($request->all());
    }
}
