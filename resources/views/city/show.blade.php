<!--shows the Categories of one specific City-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/categories.css') }}" >

@extends('layouts.layout')
    @section('content')

    <div class="container">
        <div class="city">
            <div class="city--head"><h1>Welcome to <span class="city--head__bold">{{ $city->name}}</span></h1></div>
        </div>  

        <div class="category">
            @foreach ($categories as $category)
                <div class="category__item">
                    <div class="child">
                        <a class="child--link" href="{{ route('activity.show', [$city->id, $category->id]) }}">{{ $category->name }}</a>
                    </div>
                    <p class="item">{{ $category->description }}</p>
                </div>
            @endforeach
        </div>
    </div>

    @endsection
