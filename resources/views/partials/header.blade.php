<link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}" >

    <div class="header">

        <div class="header--nav">
            <button class="header--nav__button">Menu</button>

            <div class="header--nav__content">
                @guest
                <a class="link" href="/login">Login</a>   
                <a class="link" href="/register">Register</a>
                @if (Route::current()->getName() != 'city.index')
                    <a class="link" href="/">Home</a>
                @elseif(Route::current()->getName() == 'activity.detail')
                    <a class="link" href="/cities/{{ $city->id }}/categories">Categories</a>
                    <a class="ink" href="/cities/{{ $city->id }}/{{ $category->id }}/activities">Activities</a>
                @endif 
                @endguest

                @auth
                <a class="link" href="/logout">Logout</a>
                <a class="link" href="/profile/{{ Auth::user()->id }}">My Profile</a>
                <a class="link" href="/activities/create">Create Activity</a>
                @if (Route::current()->getName() != 'city.index')
                    <a class="link" href="/">Home</a> 
                @endif
                @endauth


            </div>
                
        </div>

    </div>



