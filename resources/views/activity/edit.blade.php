
<!--edit Activity-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/editactivity.css') }}" >


@extends('layouts.layout')
@section('content')
    <h1 class="create--head">Edit your Activity</h1>

    <div class="edit--form">
        <form method="post" action="{{action('ActivityController@update', $activity->id )}}">
            @csrf

            <div class="hidden">
                <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
            </div>

            <div class="row">
                <div class="elm">
                    <label for="activityName">Name of Activity</label>
                </div>
                <div class="input">
                    <input type="text" id="activityName" value="{{$activity->name}}">
                </div>
            </div>

            <div class="row">
                <div class="elm">
                    <label for="subject">Description</label>
                </div>
                <div class="input">
                    <textarea id="description" name="description" value="{{$activity->description}}" style="height:200px"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="elm">
                    <label for="groupSize">Group Size</label>
                </div>
                <div class="input">
                    <input type="text" id="groupSize" name="group_size" value="{{$activity->group_size}}">
                </div>
            </div>

            <div class="row">
                <div class="elm">
                    <label for="price">Price per Hour</label>
                </div>
                <div class="input">
                    <input type="text" id="price" name="price" value="{{$activity->price}}">
                </div>
            </div>

            <div class="row">
                <div class="elm">
                    <label for="time">Date and Time</label>
                </div>
                <div class="input">
                    <input type="datetime-local" id="time" name="date_time" value="YYYY-MM-DDTHH:MM" value="{{$activity->date_time}}">
                </div>
            </div>

            <div class="row">
                <div class="elm">
                    <label for="address">Address</label>
                </div>
                <div class="input">
                    <input class="elm--input" type="text" name="address" value="{{$activity->address}}">
                </div>
            </div>

            <div class="row">
                <div class="elm">
                    <label for="postcode">Postcode</label>
                </div>
                <div class="input">
                    <input class="elm--input" type="text" name="postcode" value="{{$activity->postcode}}">
                </div>
            </div>

            <div class="row">
                <input type="submit" value="Submit">
            </div>
        </form>      
    </div>
@endsection



