  <style>
    @font-face {
      font-family: Montserrat-Black;
      src: url('{{ asset('fonts/Montserrat-Black.otf') }}');
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Navbar Styling */
    nav {
      font-family: Montserrat-Black;
      font-size: 24px;
      background-color: white;
      padding: 15px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
      box-shadow: 0 2px 5px rgba(16, 153, 8, 0.1);
      margin-bottom: 70px;
      height: 100px;
    }

    /* Brand Name */
    .navbar-brand {
      font-size: 36px;
      color: green;
      font-weight: bold;
      text-decoration: none;
      display: flex;
      align-items: center;
      height: 100%;
    }

    /* Nav Items Container */
    .nav-links {
      display: flex;
      align-items: center;
      list-style: none;
      height: 100%;
      margin: 0;
      padding: 0;
    }

    /* Individual Nav Items */
    .nav-links li {
      margin: 0 15px;
      position: relative;
      display: flex;
      align-items: center;
      height: 100%;
    }

    .nav-links a {
      text-decoration: none;
      font-weight: bold;
      padding: 10px;
      display: flex;
      align-items: center;
    }

    /* Link Colors */
    .nav-links .nav-item-home a {
      color: #00274D;
    }

    .nav-links .nav-item-home a:hover {
      color: green;
    }

    .nav-links .nav-item-products a {
      color: green;
    }

    .nav-links .nav-item-products a:hover {
      color: #00274D;
    }

    .nav-links .nav-item-cart a {
      color: green;
    }

    .nav-links .nav-item-cart a:hover {
      color: #00274D;
    }

    /* Cart Icon */
    .nav-item-cart i {
      font-size: 20px;
      margin-left: 5px;
    }

    /* Dropdown Menu */
    .dropdown {
      position: absolute;
      top: 100%;
      left: 0;
      background: white;
      border-radius: 5px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      display: none;
      width: 150px;
      padding: 10px 0;
    }

    .dropdown li {
      display: block;
      padding: 5px 15px;
    }

    .dropdown li a {
      font-size: 18px;
      font-family: Montserrat;
      display: block;
      color: black !important;
    }

    .dropdown li a:hover {
      background: #f4f4f4;
    }

    /* Show dropdown on hover */
    .nav-item-products:hover .dropdown {
      display: block;
    }

    /* Dropdown Arrow */
    .fa-caret-down {
      margin-left: 5px;
      transition: transform 0.3s;
    }

    .nav-item-products:hover .fa-caret-down {
      transform: rotate(180deg);
    }

    /* Login/Register Button */
    .login-btn {
      background-color: green;
      color: white;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 20px;
      text-decoration: none;
      display: inline-block;
    }

    .login-btn:hover {
      background-color: darkgreen;
    }
  </style>
  <nav>
    <a class="navbar-brand" href="{{route('home')}}">Konekta</a>
    <ul class="nav-links">
      <li class="nav-item-home">
        <a href="{{route('home')}}">Home</a>
      </li>
      <li class="nav-item-products">
        <a href="#">Products <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown">
          <li><a href="#">Vegetables</a></li>
          <li><a href="#">Fruits</a></li>
        </ul>
      </li>
      <li class="nav-item-cart">
        <a href="{{route('cart.show')}}">Cart</a><i class="fas fa-shopping-cart"></i>
      </li>
      @if(Auth::guard('merchant')->check())
        <li><a href="{{route('merchant.profile', Auth::guard('merchant')->user()->id)}}">Profile</a></li>
        <li><a href="{{route('logout')}}" class="login-btn">Logout</a></li>
      @elseif(Auth::check())
        <li><a href="{{route('user.profile')}}">Profile</a></li>
        <li><a href="{{route('logout')}}" class="login-btn">Logout</a></li>
      @else
        <li><a class="login-btn" href="{{route('user_login')}}">Login</a></li>
      @endif
    </ul>
  </nav>