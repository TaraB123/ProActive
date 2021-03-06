<link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}" >

@extends('layouts.layout')
    @section('content')

        <div class="homepage">
            
            <div class="aside">
                <h1 class="homepage--headline">Ready for an adventure?</h1>
            </div>
            
            <div class="main">
                <div><h2 class="homepage--sub">You don't always have to travel wide and far to find <span>adventures</span>. With your eyes wide <span>open</span> you'll find excitement in every corner of your <span>neighborhood</span>.</h2></div>
                
                <div class="homepage--nav">
                    <button class="homepage--nav__button">Select your City</button>
                    <div class="homepage--nav__content">
                        @foreach ($cities as $city)
                        <a class="content" href="/cities/{{ $city->id }}/categories">{{$city->name}}</a>
                        @endforeach
                    </div>
                </div>  

                <div id="slider">
                    <figure>
                        <img src="" />
                        <img src="" />
                        <img src="" />
                        <img src="" />
                        <img src="" />
                    </figure>
                </div>

                
            </div>              
        </div>

    




@endsection 
