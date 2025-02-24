<nav class="navbar navbar-expand-lg bg-body-tertiary" style="position: fixed; width: 100%; top: 0; z-index: 1000;">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('home')}}">{{config('app.name')}}</a>
    
    <div class="search-bar d-flex align-items-center position-relative ms-3">
      <i class="fas fa-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: gray;"></i>
      <input class="form-control ps-5" type="search" placeholder="Search brand, products..." aria-label="Search" 
        style="width: 600px; border-radius: 20px; padding-left: 40px;">
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" 
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav d-flex align-items-center">
        <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Offers</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('cart.show')}}"><i class="fas fa-shopping-cart"></i> My Cart</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('favorites.show')}}"><i class="fas fa-heart"></i> Favorites</a></li>
        @auth
          <li class="nav-item"><a class="nav-link ms-3" href="{{route('logout')}}">Logout</a></li>
        @else
          <li class="nav-item"><a class="nav-link ms-3" href="{{route('merchant_login')}}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('merchant_registration')}}">Registration</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>