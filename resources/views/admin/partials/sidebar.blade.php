<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{$dashboard_url}}" class="brand-link">
        <img src="/admin/img/AdminLTELogo.png" alt="Admin Tesla Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Greyscale Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($nav as $title => $route)
                    <li class="nav-item">
                        <a href="{{$route}}" class="nav-link">
                            <i class="fas fa-table nav-icon"></i>
                            <p>{{$title}}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
