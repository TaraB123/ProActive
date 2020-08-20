<?php

namespace App\Http\Controllers;

use App\City; 
use App\User; 
use App\Activity;
use App\Category;
use App\Review;
use DB; 


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 

class ActivityController extends Controller
{
    // Show Activities in one Category and one City
    public function show($city_id,$category_id)
    {
        $city = City::findOrFail($city_id); 
        $category = Category::findOrFail($category_id); 
        $activities = Activity::where([
            ['city_id', $city_id],
            ['category_id', $category_id],
        ])->paginate(2);

        return view('activity.show', compact('city', 'category', 'activities')); 

    }

    // Show Detail of Specific Activity
    public function detail($city_id,$category_id,$activity_id)
    {
        $category = Category::findOrFail($category_id);
        $city = City::findOrFail($city_id); 
        $activity = Activity::findOrFail($activity_id); 
        $reviews = $activity->reviews; 
        $owner = $activity->user;
        $activities = Activity::where('user_id', $owner->id)->get(); 

        $user = auth()->user(); 

        return view('activity.detail', compact('activity', 'city', 'owner','user', 'category', 'activities', 'reviews')); 
    }

    // Create Activity
    public function create()
    {
        $activities = Activity::all();
        $cities = City::all(); 
        $categories = Category::all(); 
        $users = User::all(); 
       
        return view('activity.create', compact('activities', 'cities', 'categories', 'users'));
    }

    // Store Activity
    public function store(Request $request)
    { 
        $this->validate($request, 
            [
                'user_id' => 'required',
                'city_id' => 'required',
                'category_id' => 'required',
                'name' => 'required|string',
                'description' => 'required|string|min:30|max:500',
                'group_size' => 'required|int|min:1|max:50',
                'price' => 'required|int|max:255',
                'date_time' => 'required|string|max:255',
                'address' => 'required|string|min:10|max:255',
                'postcode' => 'required|int|min:4',
                'email' => 'required|string|min:6|max:255',
            
            ]
        ); 

        $activity = new Activity;
        $activity->user_id= $request->input('user_id');
        $activity->city_id = $request->input('city_id');
        $activity->category_id = $request->input('category_id');
        $activity->name = $request->input('name');
        $activity->description = $request->input('description');
        $activity->group_size = $request->input('group_size');
        $activity->price = $request->input('price');
        $activity->date_time = $request->input('date_time');
        $activity->address = $request->input('address');
        $activity->postcode = $request->input('group_size');
        $activity->email = $request->input('email');
        $activity->save();
    
        return redirect('/');

    }
    // Register for Activity
    public function registerActivity(Request $request)
    {
        
        $user = auth()->user(); 
        $user_id = auth()->user()->id; 
        $activity_id = $request->input('activity_id');
        $activity = Activity::findOrFail($activity_id); 

        if ($user_id === $activity->user_id)
        {
            return redirect()->back()->with('alert', 'You cannot register for your own activity.'); 
        }
        elseif ($user->registered()->where('activity_id', $activity_id)->exists())
        {
           return redirect()->back()->with('alert', 'Sorry, you are registered!');
        }
        elseif ($user->registered()->where('activity_id', $activity_id)->doesntExist())
        {
           
            $user->registered()->attach($activity_id);
            $activity->decrement('group_size'); 
            DB::table('activities')->update(["group_size"=>DB::raw("greatest(group_size - 1, 0)")]);
            return redirect()->back()->with('alert', 'registered!');
        }
        
        return redirect(action('ActivityController@detail', [$activity->city_id,$activity->category_id,$activity->id ]));
    }
    // Delete Activity as Owner
    public function removeActivity(Request $request){
        $user = auth()->user(); 
        $activity_id = $request->input('activity_id');
        $activity = Activity::findOrFail($activity_id);
        
        $activity->delete();
        return redirect(action('ProfileController@show', $user->id));;
    }

    // Remove Activity from your list as User
    public function removeRegistration(Request $request)
    {
        $user = auth()->user(); 
        $activity_id = $request->input('activity_id');
        $activity = Activity::findOrFail($activity_id); 
       
        $user->registered()->detach($activity_id);
        $activity->increment('group_size'); 
        
        return redirect(action('ProfileController@show', $user->id));
    }
  
    // Search for Activities
    public function search(Request $request)
    {
        
        $activity_input = $request->input('activity_input'); 
        $city_id = $request->input('city_id'); 
        $category_id = $request->input('category_id'); 
        
        $activities = Activity::where([
            ['city_id', $city_id], 
            ['category_id', $category_id], 
            ['name', 'LIKE', '%' . $activity_input . '%'],
        ])->get(); 
        
        $city = City::findOrFail($city_id); 
        $category = Category::findOrFail($category_id);

        return view('activity.show', compact('category', 'activities', 'city')); 

    }

    public function edit($activity_id)
    {   
        $user = auth()->user(); 
    
        $activity = Activity::findOrFail($activity_id);
        
        return view('activity.edit', compact('user', 'activity'));
    }

    public function update($activity_id, Request $request){
        $user = auth()->user(); 

        $activity = Activity::findOrFail($activity_id);

        $activity->user_id= $request->input('user_id');
        // $activity->city_id = $request->input('city_id');
        // $activity->category_id = $request->input('category_id');
        $activity->name = $request->input('name');
        $activity->description = $request->input('description');
        $activity->group_size = $request->input('group_size');
        $activity->price = $request->input('price');
        $activity->date_time = $request->input('date_time');
        $activity->address = $request->input('address');
        $activity->postcode = $request->input('group_size');
        $activity->email = $request->input('email');
        $activity->save();

        return redirect('/profile/' . $user->id);
    }

    public function review(Request $request, $city_id, $category_id, $activity_id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'user_name' => 'required', 
            'text' => 'required|max:255',
            'rating' => 'nullable|numeric|min:1|max:5'
        ], [
            'rating.between' => 'That number is outside of bounds.',
            'text.required' => 'A review without a text does not make sense, love.',
            'text.max' => 'That is too much text!'
        ]);

        // prepare empty object (because this is create)
        $review = new Review;

        // fill object with data
        $review->activity_id = $activity_id; 
        $review->user_id = $request->input('user_id');
        $review->user_name = $request->input('user_name');
        $review->text = $request->input('text');
        $review->rating = $request->input('rating');

        $user_id = auth()->user()->id; 
        $user_name = auth()->user()->name; 
        $activity_id = $activity_id;  
        
        
        if (Review::where([
            ['user_id', '=', $user_id], 
            ['activity_id', '=', $activity_id],
        ])->exists())
        {
            session()->flash('success_message', 'You already left a review for this activity!'); 
            return redirect()->back(); 
        }
        else {
            $review->save();

            session()->flash('success_message', 'Review was saved. Thank you!');

            return redirect()->action('ActivityController@detail', [ $city_id, $category_id, $activity_id ]);
        }
    }   
}