<nav class="navbar navbar-expand-lg bg-primary navbar-blue fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="{{url("/")}}">
            <img class="me-3 d-inline-block" src="{{asset('frontend/assets/img/favicons/favicon-32x32.png')}}" alt="" /></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto pt-2 pt-lg-0 font-base">
                <li class="nav-item px-2" data-anchor="data-anchor">
                    <a class="nav-link text-white fw-bold active" aria-current="page" href="{{url('/')}}">Home</a></li>

            </ul>
            @if (Route::has('login'))
            <form class="ps-lg-5">
                @auth
                    <a href="{{route('home')}}" class="btn btn-link hover-top btn-success text-white fw-bold order-1 order-lg-0" type="button">Dashboard</a>
                @else
                <a href="{{route('login')}}" class="btn btn-link hover-top btn-success text-white fw-bold order-1 order-lg-0" type="button">Sign in</a>
{{--                <a class="btn hover-top btn-collab" href="{{route('register')}}">Sign Up</a>--}}
            @endauth
            </form>
            @endif
        </div>
    </div>
</nav>
