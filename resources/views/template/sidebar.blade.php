<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{url('/dashboard')}}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            @if($session['role'] === 'admin')
                <li class="nav-item">
                    <a href="{{url('/user')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/kategori-ruangan')}}" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>
                                    Kategori Ruangan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/hak-milik')}}" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>
                                    Hak Milik
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/fasilitas')}}" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>
                                    Fasilitas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/ruangan')}}" class="nav-link">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>
                                    Ruangan
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        APP Peminjaman
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/pinjam-ruangan')}}" class="nav-link">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>
                                Fasilitas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/pinjam-ruangan-calender')}}" class="nav-link">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>
                                Kalender
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{url('/peminjaman')}}" class="nav-link">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>
                        Pinjam Ruangan
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
