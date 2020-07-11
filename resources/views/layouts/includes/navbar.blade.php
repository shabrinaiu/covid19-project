<div class="nav col-md-12 navbar-right">
    <h4>Website by PENS</h4>
</div>
<div class="nav navbar-header col-md-5">
    <li>
        <h2 class="welcome-message">PENS</h2>
        <h3>Health Information</h3>
    </li>
</div>
<ul class="nav navbar-top-links navbar-right">
    <li class="">
        <a href="">
            <i class="fa fa-globe"></i> 
            <span class="nav-label">Home</span>
        </a>
    </li>
    <li class="dropdown {{ (request()->is('reports/countries') || request()->is('reports/countries/*') || request()->is('reports/global') || request()->is('reports/global/*')) ? 'active' : '' }}">
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
        </ul>
    </li>
</ul>