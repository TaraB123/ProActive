<!--Shows the details of one specific Activity-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/detail.css') }}" >

@extends('layouts.layout')

@section('content')

<div class="detail">

    <div class="detail--sub">
        <div class="elm">
            <h1 class="h1">{{ $activity->name }}</h1>
            <p class="detail--headline__description"> {{ $activity->description }}</p>    
        </div>
    </div>

    <div class="detail--sub">
        <div class="elm">
            <p class="detail--facts__item">Available Places: {{$activity->group_size}}</p>
            <p class="detail--facts__item">Starts: {{$activity->date_time}}</p>
            <p class="detail--facts__item">Address: {{$activity->adress}}</p>
            <p class="detail--facts__item">Postcode: {{$activity->postcode}}</p>
            @if ($city->id == 1)
                <p class="detail--facts__item">Price in CZK: {{$activity->price}}</p>
            @elseif($city->id == 2)
                <p class="detail--facts__item">Price in EUR: {{$activity->price}}</p>
            @endif
        </div>
    </div>


    <div class="detail--sub">
        <div class="elm">
            @auth
            <form method="POST" action="{{ action('ActivityController@registerActivity') }}">
            @csrf
                
                <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                <input type="hidden" value="{{$activity->id}}" name="activity_id">
            
            <div class="button"><button class="btn--detail" type="submit" >Register for this activity</button></div>
            @if (session('alert'))
                <div class="alert alert-success">
                    {{ session('alert') }}
                </div>
            @endif
            </form>
            @endauth
        </div>  
    </div>

    
    @guest
    <div class="detail--sub">
        <div class="elm">
            <a class="detail--login__link" href="/login">Login to take part</a>
        </div>
    </div>
    @endguest
    
    <div class="detail--sub">
        <div class="elm">
            @if ($owner !== null) 
            <h2 class="h2">About {{ $owner->name }}:</h2>
            <p>{{ $owner->description }}</p>
            <p>Contact Me: {{ $activity->email }}</p>
            @endif
        </div>
    </div> 

    <div class="detail--sub">
        <div class="elm">
            <h2 class="h2">More Activities by {{ $owner->name }}</h2>
            @foreach ($activities as $activity)
            <div class="detail--related__name"><a class="detail--related__link" href="{{ route('activity.detail', [$city->id, $category->id, $activity->id]) }}">{{ $activity->name }}</a></div>
            @endforeach
        </div>
    </div>

    <div class="detail--sub">
        <div class="elm">
            <h2 class="h2">Reviews</h2>
            @foreach ($reviews as $review)
            <div class="review">
                <p class="review--owner">{{ $review->user_name }}</p>
                <p class="review--text">{{ $review->text }}</p>
                <div class="review--rating">{{ $review->rating }} out of 5</div>
            </div>
            @endforeach
        </div>
    </div>

    @auth
    <div class="detail--sub">
        <div class="elm">
            <h2 class="h2">Create a Review</h2>
            <form action="{{ route('activity.review', [ $city->id, $category->id, $activity->id ]) }}" method="post" class="review-form">
                @csrf
    
                {{-- success message --}}
                @if (Session::has('success_message'))
                    <div class="alert alert-success">
                        {{ Session::get('success_message') }}
                    </div>
                @endif
    
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                        
                <div class="hidden">
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                </div>
    
                <div class="hidden">
                    <input type="hidden" value="{{Auth::user()->name}}" name="user_name">
                </div>
    
    
                <div class="form-group">
                    <label for="">
                        <textarea class="text" placeholder="Enter your review"  name="text" cols="30" rows="5">{{ old('text') }}</textarea>
                    </label>
                </div>
                
                <div class="form-group">
                    <label for="">
                        Rating:<br>
                        <input type="number" name="rating" value="{{ old('rating') }}" min="0" max="5">
                    </label>
                </div>
    
                <div class="form-group">
                    <button>Submit review</button>
                </div>
            </form>
        </div>
    @endauth 
    </div> 
    
    <div class="detail--sub">
        @guest
        <p>
            You can log-in here: <a href="{{ route('login') }}">Login</a>
        </p>
        @endguest
    </div>
    

    
</div>

    
@endsection

