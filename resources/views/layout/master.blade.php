{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>

<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">HackerShelf</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                

                
                <li class="nav-item">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a class="nav-link" href="{{ route('catalogue') }}">Admin Catalogue</a>
                        @else
                            <a class="nav-link" href="{{ route('seeHome') }}">Home</a>
                        @endif
                    @endauth

                    @guest
                        <a class="nav-link" href="{{ route('seeHome') }}">Home</a>
                    @endguest

                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>

                      
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                      </li>

                </li>

            
                @auth
                @if(auth()->user()->role !== 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('addproduct') }}">Add Product</a>
                    </li>
                @endif
            @endauth  

            </ul>


        
            @auth
                @if(auth()->user()->role !== 'admin')
                <a class="btn btn-outline-light me-2" href="{{ route('profile') }}">
                    {{ auth()->user()->username ?? 'Profile' }}
                </a>
                @endif
            @endauth

            @guest
                <a class="btn btn-outline-light me-2" href="{{ route('seeLogin') }}">
                    Guest (Login)
                </a>
            @endguest


           
            @auth
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
            @endauth

        </div>
    </div>
</nav>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-apk-hci.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdn.vercel.app/geist/1.0.0/geist.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-footer.css') }}">
    @stack('styles')
</head>
<body>
  <nav class="navbar">
    <div class="logo">
      <img src="{{ asset('assets/images/logo-apk-hci.png') }}" class="logo-img" alt="HackerShelf Logo">
    </div>

    <ul class="menu">
      @if(Route::currentRouteName() !== 'seeHome')
        <li><a href="{{ route('seeHome') }}">Home</a></li>
      @endif
      <li><a href="{{ route('seeHome') }}#categoryCarousel">Tools</a></li>
      <li><a href="{{ route('addproduct') }}">Add Tool</a></li>
      {{-- <li><a href="{{ route('addproduct') }}">Deploy Tools</a></li> --}}
      <li><a href="{{ route('about') }}">About</a></li>
    </ul>

    <div class="navbar-right">
      @auth
        <a href="{{ route('profile') }}" class="profile-btn">
          <i class="fas fa-user"></i> Profile
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="profile-btn" style="border: none; background: none; cursor: pointer; padding: 12px 18px;">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      @endauth
      
      @guest
        <a href="{{ route('seeLogin') }}" class="profile-btn">
          <i class="fas fa-user"></i> Login
        </a>
      @endguest
    </div>
  </nav>

  @yield('content')

  <footer>
    <div class="footer-container">
      <div class="footer-logo">
        <img src="{{ asset('assets/images/logo-apk-hci.png') }}" alt="Hackershelf Logo">
      </div>
      <div class="footer-social">
        <a href="#" aria-label="X (Twitter)"><img src="{{ asset('assets/images/x-logo.png') }}" alt="X"></a>
        <a href="#" aria-label="Instagram"><img src="{{ asset('assets/images/instagram-logo.png') }}" alt="Instagram"></a>
        <a href="#" aria-label="YouTube"><img src="{{ asset('assets/images/youtube-logo.png') }}" alt="YouTube"></a>
        <a href="#" aria-label="LinkedIn"><img src="{{ asset('assets/images/linkedin-logo.png') }}" alt="LinkedIn"></a>
      </div>
      <div class="footer-links">
        <div class="footer-column">
          <h4>Category</h4>
          <ul>
            <li><a href="{{ route('showCategory', 1) }}">Forensic</a></li>
            <li><a href="{{ route('showCategory', 2) }}">Binary Exploitation</a></li>
            <li><a href="{{ route('showCategory', 3) }}">OSINT</a></li>
            <li><a href="{{ route('showCategory', 4) }}">Reverse Engineer</a></li>
            <li><a href="{{ route('showCategory', 5) }}">Cryptography</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Section</h4>
          <ul>
            <li><a href="{{ route('seeHome') }}#categoryCarousel">Tools</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  @stack('scripts')
</body>
</html>