<h6 class="navbar-heading text-muted">
 @if (auth()->user()->role == 'admin')
  Gestionar datos
@else
  Menú
@endif
</h6>
<ul class="navbar-nav">
  @if (auth()->user()->role == 'admin')
  <li class="nav-item">
    <a class="nav-link" href="/home">
      <i class="ni ni-tv-2 text-red"></i> Dashboard
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/deportes">
      <i class="ni ni-user-run text-blue"></i> Deportes
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/courts">
      <i class="ni ni-map-big text-red"></i> Campos deportivos
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/clients">
      <i class="ni ni-single-02 text-info"></i> Clientes
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/appointments">
      <i class="ni ni-time-alarm text-warning"></i> Reservas
    </a>
  </li>
  @elseif(auth()->user()->role == 'empleado')
  <li class="nav-item">
    <a class="nav-link" href="/schedule">
      <i class="ni ni-calendar-grid-58 text-red"></i> Gestionar Horario
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/appointments">
      <i class="ni ni-time-alarm text-primary"></i> Mis reservas
    </a>
  </li>

  @else{{--client--}}
  <li class="nav-item">
    <a class="nav-link" href="/appointments/create">
      <i class="ni ni-laptop text-danger"></i> Reservar campo
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/appointments">
      <i class="ni ni-time-alarm text-info"></i> Mis reservas
    </a>
  </li>
  @endif
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-key-25 text-gray"></i> Cerrar sesión 
    </a>
       <form action="{{ route('logout') }}" method="POST" style="display:none;" id="formLogout">
      @csrf
    </form>
  </li>
</ul>
 @if (auth()->user()->role == 'admin')
{{--Divider --}}
<hr class="my-3">
{{-- Heading --}}
<h6 class="navbar-heading text-muted">Reportes</h6>
{{-- Navigation --}}
<ul class="navbar-nav mb-md-3">
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/charts/appointments/line')}}">
      <i class="ni ni-collection text-yellow"></i> Frecuencia de Reservas 
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/charts/courts/column')}}">
      <i class="ni ni-trophy text-orange"></i> Canchas más activas
    </a>
  </li>
</ul>
@endif