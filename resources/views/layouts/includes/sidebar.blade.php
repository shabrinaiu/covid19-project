<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element">
                <img alt="image" class="rounded-circle" src="{{URL::asset('theme/img/profile_small.jpg')}}"/>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="block m-t-xs font-bold">Username</span>
                    <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                    <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                    <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="login.html">Logout</a></li>
                </ul>
            </div>
            <div class="logo-element">
                <img class="absolute2" src="{{URL::asset('theme/img/yems/asset-1.png')}}" alt="">
            </div>
        </li>
        <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
        </li>

        <li class="{{ request()->is('reports/*') ? 'active' : '' }}">
            <a href="#"><i class="fa fa-area-chart"></i> <span class="nav-label">Reports</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                {{-- <ul class="nav nav-second-level">
                    <li class=""><a href="#">Data</a></li>
                </ul> --}}
                <li class=" {{ (request()->is('reports/global') || request()->is('reports/global/*')) ? 'active' : '' }}">
                    <a href="{{ route('global.index')}}"><i class="fa fa-globe"></i> <span class="nav-label">Global</span></a>
                </li>
                <li class=" {{ (request()->is('reports/countries') || request()->is('reports/countries/*')) ? 'active' : '' }}">
                    <a href="{{ route('countries.index')}}"><i class="fa fa-flag-o"></i> <span class="nav-label">Countries</span></a>
                </li>
            </ul>
        </li>

    </ul>
</div>
