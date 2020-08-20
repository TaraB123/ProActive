<!--creates new Activity-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/create.css') }}" >

@extends('layouts.layout')
@section('content')
    <h1 class="create--head">Create your Activity</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="create--form">
        <form method="post" action="{{ action('ActivityController@store') }}">
            @csrf
            
            <!-- Transmitting User_id-->
            <div class="hidden">
                <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
            </div>
        
            <!-- City Selection-->
            <div class="row">
                <div class="elm">
                    <label for="city">Select your City</label>
                </div> 
                <div class="input">
                    <select class="elm--select" name="city_id" id="cities" >
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>       
            </div>

            <!-- Category Selection -->
            <div class="row">
                <div class="elm">
                    <label for="city">Select a Category</label>
                </div> 
                <div class="input">
                    <select class="elm--select" name="category_id" id="categories">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>       
            </div>

            <!-- Name of Activity-->
            <div class="row">
                <div class="elm">
                    <label for="activityName">Name of Activity</label>
                </div>
                <div class="input">
                    <input type="text" id="activityName" name="name" placeholder="required">
                </div>
            </div>
            
            <!-- Description -->
            <div class="row">
                <div class="elm">
                    <label for="subject">Description</label>
                </div>
                <div class="input">
                    <textarea id="description" name="description" placeholder="min 30 characters" style="height:200px"></textarea>
                </div>
            </div>

            <!-- Group Size -->
            <div class="row">
                <div class="elm">
                    <label for="groupSize">Group Size</label>
                </div>
                <div class="input">
                    <input type="text" id="groupSize" name="group_size" placeholder="min-size 1">
                </div>
            </div>

            <!-- Price -->
            <div class="row">
                <div class="elm">
                    <label for="price">Price per Hour</label>
                </div>
                <div class="input">
                    <input type="text" id="price" name="price" placeholder="required">
                </div>
            </div>

            <!-- Time -->
            <div class="row">
                <div class="elm">
                    <label for="time">Date and Time</label>
                </div>
                <div class="input">
                    <input type="datetime-local" id="time" name="date_time" value="YYYY-MM-DDTHH:MM">
                </div>
            </div>

            <!-- Address -->
            <div class="row">
                <div class="elm">
                    <label for="address">Address</label>
                </div>
                <div class="input">
                    <input class="elm--input" type="text" name="address" placeholder="Street, Number">
                </div>
            </div>
            
            <!-- Postcode -->
            <div class="row">
                <div class="elm">
                    <label for="postcode">Postcode</label>
                </div>
                <div class="input">
                    <input class="elm--input" type="text" name="postcode" placeholder="required">
                </div>
            </div>
            
            <!-- Contact Mail -->
            <div class="row">
                <div class="elm">
                    <label for="mail">Contact Email</label>
                </div>
                <div class="input">
                    <input class="elm--input" type="text" name="email" value="{{ Auth::user()->email }}">
                </div>
            </div>
                    
            <div class="row">
                <input type="submit" value="Submit">
            </div>
            
        </form>

    </div>
    
@endsection

