<nav class="navbar navbar-expand bg-powder-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <strong><span class="nav-link text-light">Stucknoflow</span></strong>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('/about') }}">About</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @guest
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Daftar') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{ route('profil.edit', Auth::id()) }}">Profil</a>
                <a class="dropdown-item" href="{{ route('pertanyaan.index') }}">Pertanyaan</a>
                <a class="dropdown-item" href="{{ route('tag.index') }}">Tag</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
</nav>