<ul class="navbar-nav mb-2 mb-md-0">
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
<a class="btn btn-primary ms-auto mb-2 mb-md-0" href="{{ route('login') }}" > 
<i class="fas fa-sign-in-alt"></i> Login</a>