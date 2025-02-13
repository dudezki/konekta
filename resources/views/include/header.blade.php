<nav class="navbar navbar-expand-lg bg-body-tertiary" style="position: fixed; width: 100%; top: 0; z-index: 1000;">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('home')}}">{{config('app.name')}}</a>
    <div class="search-bar" style="position: relative;">
      <input class="form-control me-2" type="search" placeholder="Search brand, products..." aria-label="Search" style="width: 700px; margin-left: 50px; border-radius: 20px; padding-left: 40px;">
      <div class="icon" style="position: absolute; left: 60px; top: 50%; transform: translateY(-50%);">
        <i class="fas fa-search"></i>
      </div>
    </div>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0 list-unstyled d-flex">
      <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Offers</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{route('cart.show')}}">
            <i class="fas fa-shopping-cart"></i> My Cart
          </a>
        </li>
      @auth
        <li class="nav-item">
          <a class="nav-link" href="{{route('logout')}}" style="margin-left: 150px;">Logout</a>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}" style="margin-left: 150px;">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('registration')}}">Registration</a>
        </li>
      @endauth
    </ul>
  </div>
</nav>