<ul class="nav nav-pills mb-3" >
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"       href="{{ route('home') }}">Home</a></li>
    @if(auth()->user()->isCollaboration())
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('cabinet.vacations.home') ? 'active' : '' }}"   href="{{ route('cabinet.vacations.home') }}">Отпуска</a></li>
    @endif
    @can('director')
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.vacations.home') ? 'active' : '' }}"   href="{{ route('admin.vacations.home') }}">Все Отпуска</a></li>
    @endcan
{{--    @can('admin')--}}
{{--        <li class="nav-item"><a class="nav-link text-danger {{ request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home') }}">Админ</a></li>--}}
{{--    @endcan--}}
    @can('director')
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.users.home') ? 'active' : '' }}"  href="{{ route('admin.users.home') }}">Users</a></li>
    @endcan
</ul>
