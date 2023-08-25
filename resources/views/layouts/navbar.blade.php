<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link active">SYSTEM PP. YATIM DHUAFA AL-KHLAS SINGOSARI</a>
        </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto mr-3">
        <li class="nav-item">


        </li>

        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('/dist/img/user1-128x128.jpg') }}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">

                <li class="user-header">
                    <img src="{{asset('/dist/img/user1-128x128.jpg') }}" class="img-circle" alt="User Image">
                    <p>
                        {{ Auth::user()->name }}
                        <small>
                            @if( auth()->user()->role == 'admin' )
                                Admin
                            @elseif( auth()->user()->role == 'kabagSarpras' )
                                Kabag Sarpras
                            @elseif( auth()->user()->role == 'pengelolaCabang' )
                                Pengelola Cabang
                            @else
                                Pimpinan
                            @endif
                        </small>
                    </p>
                </li>

                <li class="user-footer p-3 text-center">
                    <div class="row ml-5">
                        <div class="pull-left">
                            <a href="#" class="nav-item">
                                <button type="button" class="btn btn-primary">Profile</button>
                            </a>
                        </div>
                        <div class="pull-right pl-3">
                            <a class="nav-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <button type="button" class="btn btn-danger">{{ __('Logout') }}</button>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>