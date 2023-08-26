<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2 pt-5">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="/admin/home " class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-desktop"></i>
                    <p>
                        Master Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('departments.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Department</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('lokasis.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Lokasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('kategoris.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('jnspengadaans.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jenis Pengadaan</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Asset Management</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Asset Report</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>