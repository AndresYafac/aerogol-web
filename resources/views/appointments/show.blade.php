@extends('layouts.panle')

@section('content')
  <div class="card shadow">

    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Reserva #{{ $appointment->id }}</h3>
        </div>
      </div>
    </div>
    <div class="card-body"> 
      <ul>
        <li>
          <strong>Fecha:</strong> {{ $appointment->schedule_date}}
        </li>
        <li>
          <strong>Hora:</strong> {{ $appointment->schedule_time_12}}
        </li> 
        
        @if ($role == 'clientes' || $role == 'admin')      
        <li>
          <strong>Cancha:</strong> {{ $appointment->court->name}}
        </li>
        @endif 

        @if($role == 'empleado' || $role == 'admin')
        <li>
          <strong>Cliente:</strong> {{ $appointment->cliente->name}}
        </li>
        @endif
        <li>
          <strong>Deporte:</strong> {{ $appointment->deporte->name}}
        </li>
        <li>
          <strong>Pago:</strong> {{ $appointment->type}}
        </li>
        <li>
          <strong>Estado:</strong> 
          @if ($appointment->status == 'Cancelada')
          <span class="badge badge-danger">Cancelada</span>
          @else
          <span class="badge badge-success">{{ $appointment->status}}</span>
          @endif
        </li>
      </ul>

      @if ($appointment->status == 'Cancelada')
      <div class="alert alert-warning">
        <p>Acerca de la cancelación :</p>
        <ul>
        @if($appointment->cancellation)
          <li>
            <strong>Fecha de cancelación:</strong>    
             {{ $appointment->cancellation->created_at}}
            </li>
            <li>
              <strong>Quién canceló la reserva ? :</strong>
              @if (auth()->id() == $appointment->cancellation->cancelled_by_id)
                Tú
              @else
                {{ $appointment->cancellation->cancelled_by->name}}
              @endif
            </li>               
            <li>
              <strong>Motivo de la cancelación:</strong>
              {{ $appointment->cancellation->justification}}
            </li>        
              @else
                <li>Esta reserva fue cancelada antes de su confirmación.</li>
              @endif
            </ul>  
        </div>
      @endif

      <a href="{{ url('/appointments')}}" class="btn btn-danger">Volver</a>
    </div>
  </div>
@endsection
