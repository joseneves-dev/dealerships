<nav class="main-nav" role="navigation">

    <input id="main-menu-state" type="checkbox" />
    <label class="main-menu-btn" for="main-menu-state">
        <span class="main-menu-btn-icon"></span> Toggle main menu visibility
    </label>

    <ul id="main-menu" class="sm sm-blue">
        <li class="{{ Request::is('home') ? 'current' : '' }}"><a href="{{ route('home') }}"><i data-feather="mail"></i>Dashboard</a></li>
        @if(Auth::user()->admin == 1)
        <li class="{{ Request::is('dealerships/*') ? 'current' : '' }}"><a href="{{ route('viewDealerships') }}"><i data-feather="mail"></i>Concessionarias</a></li>
        @else
        <li class="{{ Request::is('info') ? 'current' : '' }}"><a href="{{ route('info') }}"><i data-feather="mail"></i>Info</a></li>
        @endif
    </ul>

    @push('scripts')
    <script src="{{ asset('js/jquery.smartmenus.js') }}"></script>
    <script src="{{ asset('js/menus.js') }}"></script>
    @endpush
</nav>