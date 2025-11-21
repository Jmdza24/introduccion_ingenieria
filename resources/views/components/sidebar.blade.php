<div class="sidebar">
    <div class="sidebar-header">
        <i class="fa-solid fa-building-user"></i>
        <span class="sidebar-title">Gestor</span>
    </div>

    <ul class="sidebar-menu">

        {{-- ÍTEM: Dashboard para ambos roles --}}
        <li>
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('vigilante.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- OPCIONES SOLO PARA ADMIN --}}
        @if(auth()->user()->role === 'admin')
            <li>
                <a href="{{ route('torres.index') }}">
                    <i class="fa-solid fa-building"></i>
                    <span>Torres</span>
                </a>
            </li>

            <li>
                <a href="{{ route('apartamentos.index') }}">
                    <i class="fa-solid fa-door-open"></i>
                    <span>Apartamentos</span>
                </a>
            </li>

            <li>
                <a href="{{ route('residentes.index') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Residentes</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Consultas</span>
                </a>
            </li>
        @endif

        {{-- OPCIONES SOLO PARA VIGILANTE --}}
        @if(auth()->user()->role === 'vigilante')
            <li>
                <a href="#">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Registrar Visitas</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-user-clock"></i>
                    <span>Salida Visitas</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-list"></i>
                    <span>Consultas</span>
                </a>
            </li>
        @endif

        {{-- LOGOUT --}}
        <li>
            <a href="{{ route('logout') }}" class="logout-link">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Cerrar sesión</span>
            </a>
        </li>
    </ul>
</div>
