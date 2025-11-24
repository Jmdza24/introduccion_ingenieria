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

            <li class="sidebar-title mt-2 text-center">Administración</li>

            {{-- CRUD Torres --}}
            <li>
                <a href="{{ route('torres.index') }}">
                    <i class="fa-solid fa-building"></i>
                    <span>Torres</span>
                </a>
            </li>

            {{-- CRUD Apartamentos --}}
            <li>
                <a href="{{ route('apartamentos.index') }}">
                    <i class="fa-solid fa-door-open"></i>
                    <span>Apartamentos</span>
                </a>
            </li>

            {{-- CRUD Residentes --}}
            <li>
                <a href="{{ route('admin.residentes.index') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Residentes</span>
                </a>
            </li>

            <li class="sidebar-title mt-3 text-center">Consultas de Visitas</li>

            {{-- Historial completo --}}
            <li>
                <a href="{{ route('visitas.historial') }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span>Historial Completo</span>
                </a>
            </li>

            {{-- Consultar por fecha --}}
            <li>
                <a href="{{ route('visitas.consulta.fecha') }}">
                    <i class="fa-solid fa-calendar"></i>
                    <span>Visitas por Fecha</span>
                </a>
            </li>

            {{-- Consultar por apartamento --}}
            <li>
                <a href="{{ route('visitas.consulta.apartamento') }}">
                    <i class="fa-solid fa-building-user"></i>
                    <span>Visitas por Apartamento</span>
                </a>
            </li>

            {{-- Consultar por visitante --}}
            <li>
                <a href="{{ route('visitas.consulta.visitante') }}">
                    <i class="fa-solid fa-id-card"></i>
                    <span>Registro de Visitante</span>
                </a>
            </li>
        @endif


        {{-- OPCIONES SOLO PARA VIGILANTE --}}
        @if(auth()->user()->role === 'vigilante')

            <li class="sidebar-title mt-2 text-center">Visitas</li>

            {{-- Registrar Ingreso --}}
            <li>
                <a href="{{ route('visitas.buscar') }}">
                    <i class="fa-solid fa-user-check"></i>
                    <span>Registrar Ingreso</span>
                </a>
            </li>

            {{-- Visitantes dentro del conjunto --}}
            <li>
                <a href="{{ route('visitas.dentro') }}">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>
                    <span>Visitantes Dentro</span>
                </a>
            </li>

            {{-- Visitas del día --}}
            <li>
                <a href="{{ route('visitas.hoy') }}">
                    <i class="fa-solid fa-calendar-day"></i>
                    <span>Visitas del Día</span>
                </a>
            </li>

            {{-- Consultar Residentes (solo lectura) --}}
            <li>
                <a href="{{ route('vigilante.residentes.index') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Consultar Residentes</span>
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
