<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">@lang('language.mana')
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="admin/">
            <i class="fas fa-home"></i>
            <span>@lang('language.home')</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
            <span>@lang('language.cate')</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.category.index')}}">@lang('language.listcate')</a>
                <a class="collapse-item" href="{{route('admin.category.create')}}">@lang('language.catecre')</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTour" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
            <span>@lang('language.tour')</span>
        </a>
        <div id="collapseTour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.tour.index')}}">@lang('language.list_tour')</a>
                <a class="collapse-item" href="{{route('admin.tour.create')}}">@lang('language.create_tour')</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.payment.index')}}">
            <i class="fas fa-money-bill" aria-hidden="true"></i>
            <span>@lang('language.tour_booked')</span>
        </a>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-users"></i>
            <span>@lang('language.user')</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('user.index') }}">@lang('language.listuser')</a>
                <a class="collapse-item" href="utilities-border.html">@lang('language.listuserbook')</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-people-arrows"></i></i>
            <span>@lang('language.social')</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="login.html">@lang('language.like')</a>
                <a class="collapse-item" href="register.html">@lang('language.review')</a>
                <a class="collapse-item" href="forgot-password.html">@lang('language.comment')</a>
            </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.chart')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>@lang('language.chart')</span>
        </a>
    </li>
</ul>
