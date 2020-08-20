<link rel="stylesheet" type="text/css" href="{{ asset('css/profileedit.css') }}" >

@extends('layouts.layout')
@section('content')
    @auth
        <h1 class="head">Hello {{Auth::user()->name}}</h1>

        <div class="edit--form">
            <form class="edit__form" method="post" action="/profile/{{Auth::user()->id }}">
                @csrf
            
                <div class="row">
                    <div class="elm">
                        <label>Name</label>
                    </div>
                    <div class="input">
                        <input type="text" name="name" value="{{ Auth::user()->name }}">
                    </div>
                </div>
                
                <div class="row">
                    <div class="elm">
                        <label>Description</label>
                    </div>
                    <div class="input">
                        <textarea id="description" name="description" value="{{ Auth::user()->description }}" style="height:200px"></textarea>
                    </div>
                </div>

                <div class="row">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    @endauth
@endsection


