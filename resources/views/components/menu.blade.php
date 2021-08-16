<ul class="navbar-nav me-auto mb-2 mb-md-0">
    <li class="nav-item">
        <a class="nav-link {{ Request::is('inicio*') ? 'active':'' }}" aria-current="page" href="{{ route('inicio') }}">
            Estudio IMIV
        </a>
    </li>
    <li class="nav-item ">
        <a class="nav-link {{ Request::is('calculo_cesion*') ? 'active':'' }}" href="{{ route('inicio.cesion') }}">
            Calculo Aporte Vial
        </a>
    </li>
</ul>