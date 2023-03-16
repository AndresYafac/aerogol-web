@extends('layouts.panle')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Cancelar Reserva</h3>
        </div>
      </div>
    </div>
    <div class="card-body"> 
      @if (session('notification'))
      <div class="alert alert-success" role="alert">
        {{ session('notification') }}
      </div>
      @endif

      @if ($role == 'cliente')
      <p>
        Estás a punto de cancelar tu reserva para el día 
        {{ $appointment->schedule_date }}
         y hora {{ $appointment->schedule_time_12}}
       </p>
       @elseif ($role == 'empleado')
       <p>
        Estás a punto de cancelar tu reserva con el cliente 
        {{$appointment->cliente->name}} para el día 
        {{ $appointment->schedule_date }}
         y hora {{ $appointment->schedule_time_12}}
       </p>
       @else
       <p>
        Estás a punto de cancelar la cancha 
        {{ $appointment->court->name}} reservada 
        para el día {{ $appointment->schedule_date }}
         y hora {{ $appointment->schedule_time_12}}
       </p>
       @endif
    
    <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="justification">Por favor cúentanos el motivo de la cancelación:</label>
      <textarea required id="justification" name="justification" rows="3" class="form-control">
       </textarea>
      </div>
      

       <button class="btn btn-danger" type="submit">Cancelar reserva</button>
       <a href="{{ url('/appointments')}}" class="btn btn-primary">
         Volver al listado de reservas sin cancelar
       </a>
    </form>
    </div>
    
  </div>
@endsection
