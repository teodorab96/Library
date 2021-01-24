<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Knjizara</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/">Pocetna <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/books">Knjige</a>
        </li>
      </ul>
      @if (Route::has('login'))
      <ul class="navbar-nav ml-auto">
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Auth::user()->name}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/history">Istorija</a>
            <a class="dropdown-item" href="/userProfile">Profil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/logout">logout</a>
          </div>
        </li>
      @else
          <li class="nav-item ml-auto">
            <a href="{{ route('login') }}" class="nav-link">Login</a>
          </li>
        @if(Route::has('register'))
          <li class="nav-item">
            <a href="{{ route('register') }}" class="nav-link">Register</a>
          </li> 
        @endif
      @endauth
    @endif
      </ul>
    </div>
  </nav>