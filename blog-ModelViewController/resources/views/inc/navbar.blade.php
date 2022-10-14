{{-- <nav id="navbar" class="navbar navbar-expand-sm  ">
  <a class="navbar-brand" href="/">Laravel app</a>
  <div>
    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/posts">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/services">Services</a>
      </li>
    </ul>
  </div>
  <div class ="nav-left">
  <ul class="navbar-nav">
    <li>
      <a class="nav-link" href="/posts/create"> Create_Post </a>
    </li>
  </ul>
  </div>
  
</nav> --}}



<nav id="navbar" class="navbar navbar-expand-sm">
  
  <a class="navbar-brand" href="/">
    <img src="{{asset('logo/logo.jpg')}}" width="40" height="40" alt="logo">
  </a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/posts">Blog </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/about">About </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/services">Services</a>
      </li>
    </ul>
    
    <div class="form-inline my-2 my-lg-0">
    
    @guest
      @if (Route::has('login'))  
        <button type="button" class="btn btn-outline-light" onclick="location.href='{{ route('login') }}'">Login</button>
      @endif
      @if (Route::has('register'))
        <button type="button" class="btn btn-outline-secondary" onclick="location.href='{{ route('register') }}'">Register</button>
      @endif
    @else
    {{-- <div class="dropdown">
      <button class="dropbtn">Dropdown</button>
      <div class="dropdown-content">
      <button onclick="myFunction()" class="dropbtn btn btn-outline-light">Account</button>
      <div id="myDropdown" class="dropdown-content">
        <a class="nav-link" href="/home">Dashboard</a>
        <a  class="nav-link" href=""onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
      </div>
    </div> --}}

    <div class="dropdown">
      <button class="dropbtn btn btn-outline-light">Account</button>
      <div class="dropdown-content">
        <a class="nav-link" href="/home">Dashboard</a>
        <a  class="nav-link" href=""onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
      </div>
    </div>
      
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    @endguest
    </div>
  </div>
  
</nav>

{{-- @guest
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest








<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}