<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-5">
        <a class="nav-link active" aria-current="page" href="{{ route('user.home')}}">Home</a>
        @auth
        <a class="nav-link" href="{{ route('user.product.index')}}">Product</a>
        @else
        <a class="nav-link" href="{{route('user.login')}}">Login</a>
        <a class="nav-link" href="{{route('user.register')}}">Registration</a>

        @endauth
      </div>
      @auth
      <div class="dropdown me-5">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="navbar-text text-white">
            @auth
            {{auth()->user()->username}}
            @endauth
          </span>
        </button>
        <ul class="dropdown-menu bg-light m-0">
          <li><a href="{{route('user.content.user_profile')}}" class="dropdown-item">Users Profile</a></li>
          <li><a href="{{route('user.logout')}}" class="dropdown-item">Logout</a></li>
        </ul>
      </div>
      @endauth
    </div>
  </div>
</nav>