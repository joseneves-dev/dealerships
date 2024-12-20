<header class="main-header">
    <style>
        .user {
            color: white;
            margin: 0 auto;
        }
    </style>
    <div class="inside-header">
        <div class="d-flex align-items-center logo-box justify-content-start">
            <a href="index.html" class="logo">
                <div class="logo-lg">
                    <span class="light-logo"><img src="../../../images/logo-white-text.png" alt="logo"></span>
                    <span class="dark-logo"><img src="../../../images/logo-white-text.png" alt="logo"></span>
                </div>
            </a>
        </div>
        <nav class="navbar navbar-static-top">

            <div class="user fs-2 d-flex justify-content-center align-items-center">
                @if(Auth::user()->admin == 0)
                {{ Auth::user()->name }}
                @endif
            </div>
            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <li class="btn-group nav-item d-xl-inline-flex d-none">
                        <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="Full Screen">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <li class="btn-group nav-item d-xl-inline-flex d-none">
                        <a href="{{ route('logout') }}" class="waves-effect waves-light nav-link btn-primary-light svg-bt-icon" title="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i data-feather="power"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>