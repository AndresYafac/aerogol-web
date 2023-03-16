<div class="table-responsive">
      <!-- Projects table -->
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
            @foreach ($confirmedAppointments as $appointment)
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
              <a class="btn btn-sm btn-danger"  title="Cancelar reserva" 
              href="{{ url('/appointments/'.$appointment->id.'/cancel') }}">
                  Cancelar
                </a>
            </td>
          </tr>  
          @endforeach     
      </tbody>
    </table>
</div>


<div class="card-body">
  {{ $confirmedAppointments->links()}}
</div>