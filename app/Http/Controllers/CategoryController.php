<?php

namespace App\Http\Controllers;

use App\City; 
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($city_name)
    {
        $cities = City::findOrFail($city_name); 

        return view('category.index', compact('cities')); 
    }
}
