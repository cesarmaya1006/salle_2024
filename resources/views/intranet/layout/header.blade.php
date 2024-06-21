<nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link text-danger" type="submit">
                    <i class="fas fa-power-off"></i>
                </button>
              </form>
        </li>
        @can('layout.header.control-sidebar')
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        @endcan
    </ul>
</nav>
