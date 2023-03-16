<div class="table-responsive">
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Deporte</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($oldAppointments as $appointment)
            <th scope="row">
              {{ $appointment->deporte->name}}
            </td>
            <td>
              {{ $appointment->schedule_date}}
            </td>
            <td>
              {{ $appointment->schedule_time_12}}
            </td>      
            <td>           
              {{ $appointment->status}}
            </td>
            <td>
              <a href="{{ url('/appointments/'.$appointment->id) }}" class="btn btn-success btn-sm">
                Ver
              </a>
            </td>
          </tr>  
          @endforeach     
      </tbody>
    </table>
</div>

<div class="card-body">
  {{ $oldAppointments->links()}}
</div>

