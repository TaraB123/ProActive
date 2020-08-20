<?php

namespace App\Http\Controllers;

use App\Category; 
use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index() 
    {
        $cities = City::all(); 
        return view('city.index', compact('cities')); 
    }

    // shows all the categories of a specific city
    public function show($city_id) 
    {
        $city = City::findOrFail($city_id); 
        $categories = $city->categories; 
     
        return view('city.show', compact('city', 'categories'));
    }
}
