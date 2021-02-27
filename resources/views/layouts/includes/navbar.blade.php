<div class="nav col-md-12 navbar-right">
    <h4>Politeknik Elektronika Negeri Surabaya</h4>
</div>
<div class="nav navbar-header col-md-5">
    <li>
        <h2 class="welcome-message">PENS</h2>
        <h3>Health Information</h3>
    </li>
</div>
<ul class="nav navbar-top-links navbar-right">
    <li class="">
        <a href="{{route('home.index')}}">
            <span class="nav-label">Home</span>
        </a>
    </li>
    <li class="{{ request()->is('reports') ? 'active' : '' }}">
        <a href="{{route('reports.index')}}">
            <span class="nav-label">Global</span>
        </a>
    </li>
    <li class="{{ request()->is('reports/countries') || request()->is('reports/countries/*') ? 'active' : '' }}">
        <a href="{{ route('countries.index')}}">
            <span class="nav-label">Country</span>
        </a>
    </li>
    <li class="{{ request()->is('reports/compare') || request()->is('reports/compare/*') ? 'active' : '' }}">
        <a href="{{ route('compare.index')}}"> 
            <span class="nav-label">Comparison</span>
        </a>
    </li>
    <li class="{{ request()->is('reports/compare-all') || request()->is('reports/compare-all/*') ? 'active' : '' }}">
        <a href="{{ route('compare-all.index')}}">
            <span class="nav-label">Correlations</span>
        </a>
    </li>
    <!-- <li class="dropdown {{ (request()->is('reports/countries') || request()->is('reports/countries/*') || request()->is('reports/global') || request()->is('reports/global/*')) ? 'active' : '' }}">
        <a class="dropdown-toggle" data-toggle="dropdown" href="">
            <i class="fa fa-flag-o"></i>
            <span class="nav-label">Lihat Data</span>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
            <li>
                <a href="{{ route('global.index')}}" class="dropdown-item">
                    <div>
                        <i class="fa fa-globe"></i>
                        <strong>Data Global</strong>
                    </div>
                </a>
            </li>
            <li class="dropdown-divider"></li>
            <li>
                <a href="{{ route('countries.index')}}" class="dropdown-item">
                    <div>
                        <i class="fa fa-flag-o"></i>
                        <strong>Data Per Negara</strong>
                    </div>
                </a>
            </li>
            <li class="dropdown-divider"></li>
            <li>
                <a href="{{ route('compare.index')}}" class="dropdown-item">
                    <div>
                        <i class="fa fa-flag-o"></i>
                        <strong>Perbandingan Banyak Negara</strong>
                    </div>
                </a>
            </li>
            <li class="dropdown-divider"></li>
            <li>
                <a href="{{ route('compare-all.index')}}" class="dropdown-item">
                    <div>
                        <i class="fa fa-flag-o"></i>
                        <strong>Relasi Terdekat Suatu Negara</strong>
                    </div>
                </a>
            </li>
        </ul>
    </li> -->
</ul>