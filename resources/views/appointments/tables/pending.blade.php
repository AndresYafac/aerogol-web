<div class="table-responsive">
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Comentario</th>
            <th scope="col">Deporte</th>
             @if($role == 'cliente')
               <th scope="col">Cancha</th>
            @elseif($role == 'empleado')
              <th scope="col">Cliente</th>
            @endif
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Tipo</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($pendingAppointments as $appointment)
            <th scope="row">
              {{ $appointment->description}}
            </th>
            <td>
              {{ $appointment->deporte->name}}
            </td>
            @if($role == 'cliente')
             <td>{{ $appointment->court->name}}</td>
            @elseif($role == 'empleado')
             <td>{{ $appointment->cliente->name}}</td>
             @endif
            <td>
              {{ $appointment->schedule_date}}
            </td>
            <td>
              {{ $appointment->schedule_time_12}}
            </td>
            <td>
              {{ $appointment->type}}
            </td>       
            <td>
            @if ($role == 'admin') 
               <a class="btn btn-sm btn-primary"  title="Ver reserva" 
              href="{{ url('/appointments/'.$appointment->id) }}">
                  ver
                </a> 
            @endif 

            @if($role == 'empleado' || $role == 'admin')
            <form action="{{ url('/appointments/'.$appointment->id.'/confirm') }}"
              method="POST" class="d-inline-block">
              @csrf

              <button class="btn btn-sm btn-success" type="submit" 
              title="Confirmar reserva" data-toggle="tooltip">
                  <i class="ni ni-check-bold"></i>
                </button>
            </form>
            <a href="{{ url('/appointments/'.$appointment->id.'/cancel') }}"
              class="btn btn-sm btn-danger">
              <i class="ni ni-fat-delete"></i>
            </a>
            @else {{--cliente--}}
            <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" 
                method="POST" class="d-inline-block">
                  @csrf
                               
                  <button class="btn btn-sm btn-danger" type="submit" 
                  title="Cancelar reserva" data-toggle="tooltip">
                 <i class="ni ni-fat-remove"></i>
               </button>
              </form>  
            @endif         
              
            </td>
          </tr>  
          @endforeach     
      </tbody>
    </table>
</div>

<div class="card-body">
  {{ $pendingAppointments->links()}}
</div>

