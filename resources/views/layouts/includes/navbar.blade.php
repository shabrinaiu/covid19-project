<div class="nav navbar-header">
    <li>
        <h2 class="m-r-sm welcome-message">Welcome to PENS Health Information</h2>
    </li>
</div>
<ul class="nav navbar-top-links navbar-right">
    <form role="search" class="navbar-form-custom" action="search_results.html">
        <div class="form-group">
            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
        </div>
    </form>
    <li class=" {{ (request()->is('reports/global') || request()->is('reports/global/*')) ? 'active' : '' }}">
        <a href="{{ route('global.index')}}"><i class="fa fa-globe"></i> <span class="nav-label">Global</span></a>
    </li>
    <li class=" {{ (request()->is('reports/countries') || request()->is('reports/countries/*')) ? 'active' : '' }}">
        <a href="{{ route('countries.index')}}"><i class="fa fa-flag-o"></i> <span class="nav-label">Countries</span></a>
    </li>
</ul>