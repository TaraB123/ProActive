<link rel="stylesheet" type="text/css" href="{{ asset('css/profilepage.css') }}" >


@extends('layouts.layout')

@section('content')
    
    
    <div class="container">
        @auth
            <div class="personalinfo">

                <!-- Info About User -->
                <div class="boxinfo">
                    <h1 class="headline">Welcome {{Auth::user()->name}}</h1>
                    <div class="details">
                        <p>{{Auth::user()->description}}</p>
                        
                        <form action="{{ route('profile.edit', [$user->id]) }}">
                            <button class="submit" type="submit">Edit information about you</button>
                        </form>
                    </div>
                </div>

                <!-- Info about created Activities-->
                <div class="boxinfo">
                    <h1 class="headline">My Created Activites</h1>
                    <div class="details">
                        <!-- Display Info that User hasn't created any activities yet -->
                        @if($activity === null)
                            <p>You haven't created any activities yet. Start your journey by clicking "Create Activitiy"</p>
                        @endif

                        <!-- Display Activities if they exist-->
                        @foreach ($activities as $activity)
                            <div class="activities__activity">
                                <h3>{{ $activity->name }}</h3>
                                <p><b>Date and Time of Activity:</b><br> {{$activity->date_time}}</p>
                                <p><b>Location of Activity:</b><br>{{$activity->address}}</p>
                                <p><b>Description of Activity:</b><br>{{ $activity->description }}</p>
                                
                            </div>
                            <div class="activities__buttons">
                                <form action="{{ action('ActivityController@removeActivity', 'Auth::user()->id', 'Auth::activity()->id' ) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                    <button type="submit">Remove Activity</button>
                                </form>
                                <form action="{{ route('activity.edit', [$activity->id]) }}">
                                    <button type="submit">Edit this activity</button>
                                </form>
                            </div>
                        @endforeach 
                    </div>
                </div>

                <!-- Info About Registered Activities -->
                <div class="boxinfo">
                    <h1 class="headline">Activities I've registered for</h1>
                    <div class="details">
                        @if($register === null)
                            <p>You haven't registered for any activities yet. Start your journey by browsing your options.</p>
                        @endif

                        @foreach ($registered as $activity)
                            <div class="activities__activity">
                                <h3>{{ $activity->name }}</h3>
                                <p><b>Date and Time of Activity:</b><br>{{$activity->date_time}}</p>
                                <p><b>Location of Activity:</b><br>{{$activity->address}}</p>
                                <p>Contact Email: {{ $activity->email }}</p>
                            </div>
        
                            <form action="{{ action('ActivityController@removeRegistration', 'Auth::user()->id', 'Auth::activity()->id' ) }}" method="post">
                                @csrf
                                <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <button type="submit">Remove Activity</button>
                            </form>
                     @endforeach
                    </div>
                </div>

            </div>
        @endauth
    </div>

@endsection


