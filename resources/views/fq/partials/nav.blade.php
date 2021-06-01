<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 mb-1 text-muted">
    <span>Mi información</span>
    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
    <!-- <span data-feather="plus-circle"></span> -->
    </a>
</h6>
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ active(['profile.show', 'profile.edit']) }}" href="{{ route('profile.show') }}">
        <span data-feather="user"></span>
        Mi perfíl<span class="sr-only"></span>
        </a>
    </li>
</ul>

<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 mb-1 text-muted">
    <span>Pacientes</span>
    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
    <!-- <span data-feather="plus-circle"></span> -->
    </a>
</h6>
<ul class="nav flex-column">
    @if(App\Models\Fq\ContactUser::getAmIContact() > 0)
        <li class="nav-item">
            <a class="nav-link {{ active('fq.request.create') }}" href="{{ route('fq.request.create') }}">
                <i class="fas fa-plus"></i> Nueva Solicitud
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ active('fq.request.own_index') }}" href="{{ route('fq.request.own_index') }}">
                <i class="fas fa-inbox"></i> Mis Solicitudes
            </a>
        </li>
    @else
        @canany(['Fq: Answer request', 'Fq: Answer request medicines'])
            <li class="nav-item">
                <a class="nav-link {{ active('fq.request.create') }}" href="{{ route('fq.request.index') }}">
                    <i class="fas fa-inbox"></i> Solicitudes Pacientes FQ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active('fq.contact_user.create') }}" href="{{ route('fq.contact_user.create') }}">
                    <i class="fas fa-user-plus"></i> Crear contacto
                </a>
            </li>
        @endcanany
    @endif

</ul>

<ul class="nav flex-column">
    <li class="nav-item border-top">
        <a class="nav-link" href="{{ route('claveunica.logout') }}">
            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </a>
    </li>
</ul>
