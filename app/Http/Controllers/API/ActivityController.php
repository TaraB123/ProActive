<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Activity;


class ActivityController extends Controller
{
    public function index(Request $request)
    {

        $city_id = $request->input('city_id');
        // $activity_id = $request->input('activity_id');
        $category_id = $request->input('category_id');
        

        $activity = Activity::limit(5)
        ->orderBy('name')
        ->where('city_id', $city_id )
        ->where('category_id', $category_id )
        ->get();
      
    return($activity);
 }

       
}
