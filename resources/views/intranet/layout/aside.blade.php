<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link bg-light pb-4" style="text-decoration: none;background-color: rgba(39, 39, 39, 0.8);">
        <img src="{{asset('imagenes/sistema/escudo_salle_b.jpg')}}" alt="M & M" class="brand-image img-circle elevation-3" style="opacity: .8;">
        <span class="brand-text font-weight-light"><strong>Sistema de Evaluación</strong></span>
    </a>
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition" style="background-color: rgba(39, 39, 39, 0.8)">
        <div class="user-panel d-flex pt-3 pb-2">
            <div class="image">
                <img src="{{asset('imagenes/usuarios/usuario-inicial.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info" style="font-size: 0.85em;">
                @if (session('rol_principal_id') < 4)

                    <h6 class="text-white">{{session('rol_principal')}}</h6>
                @else
                <h6 class="text-white text-small">{{session('nombres_completos')}}</h6>
                @endif
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact" data-widget="treeview" role="menu"data-accordion="false">
                @foreach ($menusComposer as $key => $item)
                    @if ($item['menu_id'] != 0)
                        @break
                    @endif
                    @include("intranet.layout.menu-item", ["item" => $item])
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

