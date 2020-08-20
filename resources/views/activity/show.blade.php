<!--shows all the Activites of one specific Category in one specific City-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/activities.css') }}" >


@extends('layouts.layout')

@section('content')


<div class="activities__container"> 
    
    <!--Search Bar-->
    <div class="search">
        <form method="POST" action="{{ action('ActivityController@search') }}">
            @csrf
            <div class="search__input">
                <input type="hidden" name="city_id" value="{{ $city->id }}">
                <input type="hidden" name="category_id" value="{{ $category->id }}">
                <input type="text" class="input--form" name="activity_input" placeholder="Search Activity">
                <span class="input--form__btn">
                    <button type="submit" class="btn">Search</button>
                </span>
            </div>
        </form>
    </div>


    <!-- Activities -->
    <div id="activities">
        <figure>
            @foreach ($activities as $activity)
            <div class="detail">
                <div class="detail__header">   
                    <h2>
                        <a href="{{ route('activity.detail', [$city->id, $category->id, $activity->id]) }}"> {{ $activity->name }}</a>
                    </h2>
                </div> 
                <div class="detail__info">
                    <p>Starts: {{$activity->date_time}}</p>
                    <p>Where: {{$activity->adress}}</p>
                    <p>Course Description: {{ $activity->description }}</p>
                    @if ($city->id == 1)
                        <p class="detail--facts__item">Price: {{$activity->price}} Czk</p>
                    @elseif($city->id == 2)
                        <p class="detail--facts__item">Price: {{$activity->price}} Eur</p>
                    @endif
                </div>
            </div>
            @endforeach
        </figure>
    </div>

    <div class="pagination"><a href={{ $activities->links() }}</a></div>
    
</div>

@endsection
