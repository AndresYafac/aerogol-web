@extends('layouts.panle')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Registrar nueva reserva</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('clients') }}" class="btn btn-sm btn-danger">
            Cancelar y volver
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
          @endforeach
          </ul>           
      </div>
      @endif

      <form action="{{ url('appointments') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="description">Comentario</label>
          <input name="description" value="{{ old('description')}}" id="description" 
          type="text" class="form-control" 
          placeholder="Ingresa un comentario" required>
        </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Deporte</label>
          <select name="deporte_id" id="deporte" class="form-control" required>
            <option value="">Seleccionar deporte</option>
            @foreach ($deportes as $deporte)
              <option value="{{ $deporte->id }}" @if(old('deporte_id') ==
              $deporte->id) selected @endif>{{ $deporte->name }}</option>
            @endforeach
          </select>

        </div>
        <div class="form-group col-md-6">
           <label for="email">Cancha</label>
         <select name="court_id" id="court" class="form-control" required>
             @foreach ($courts as $court)
              <option value="{{ $court->id }}" @if(old('court_id') ==$court->id)
               selected @endif>{{ $court->name }}</option>
            @endforeach
          </select>

        </div>
      </div>

      <div class="form-group">
          <label for="phone">Fecha</label>
          <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
        </div>
        <input class="form-control datepicker" placeholder="Selecciona una fecha" 
        id="date" name="schedule_date" type="text" 
        value="{{ old('schedule_date' , date('Y-m-d')) }}"
        data-date-format="yyyy-mm-dd"
        data-date-start-date="{{ date('Y-m-d')}}" 
        data-date-end-date="+30d">
    </div>
      </div>
      <div class="form-group">
          <label for="address">Hora de atención</label>
          <div id="hours">
            @if ($intervals)
              @foreach ($intervals['morning'] as $key => $interval)
              <div class="custom-control custom-radio mb-3">
              <input name="schedule_time" value="{{ $interval['start'] }}" 
              class="custom-control-input" id="intervalMorning{{ $key }}" type="radio" 
              required>
                <label class="custom-control-label" for="intervalMorning{{ $key }}">
                {{ $interval['start'] }} - {{ $interval['end'] }}</label>
                </div>
              @endforeach
              @foreach ($intervals['afternoon'] as $key => $interval)
              <div class="custom-control custom-radio mb-3">
              <input name="schedule_time" value="{{ $interval['start'] }}" 
              class="custom-control-input" id="intervalAfternoon{{ $key }}" type="radio" 
              required>
                <label class="custom-control-label" for="intervalAfternoon{{ $key }}">
                  {{ $interval['start'] }} - {{ $interval['end'] }}</label>
                </div>
              @endforeach
            @else
            <div class="alert alert-info" role="alert">
              Selecciona un deporte y fecha para ver el horario disponible.
            </div>
            @endif
          </div>
        </div>
      <div class="form-group">
          <label for="type">Método de pago</label>
          <div class="custom-control custom-radio mb-3">
        <input name="type" class="custom-control-input" id="type1" type="radio"
         @if(old('type', 'Efectivo') == 'Efectivo') checked @endif value="Efectivo">
        <label class="custom-control-label" for="type1">Efectivo</label>
        </div>
        <div class="custom-control custom-radio mb-3">
        <input name="type" class="custom-control-input" id="type2" type="radio"
         @if(old('type') == 'Yape') checked @endif value="Yape">
        <label class="custom-control-label" for="type2">Yape</label>
        </div>
        <div class="custom-control custom-radio mb-3">
        <input name="type" class="custom-control-input" id="type3" type="radio"
         @if(old('type') == 'Plin') checked @endif value="Plin">
        <label class="custom-control-label" for="type3">Plin</label>
        </div>
        <div class="custom-control custom-radio mb-3">
        <input name="type" class="custom-control-input" id="type4" type="radio"
         @if(old('type') == 'Tarjeta') checked @endif value="Tarjeta">
        <label class="custom-control-label" for="type4">Tarjeta</label>
        </div>
        <p><b>*</b> Si seleccionas pagar en efectivo o tarjeta, acercate al establecimiento 10 minutos antes para pagar la reserva y confirmarla.</p>
        <p><b>*</b> Si seleccionas Yape/Plin puedes pagar al número "9632568956" y mandar la constancia al WhatsApp para confirmar la reserva.</p>
      </div>
      <button type="submit" class="btn btn-primary">
        Guardar
      </button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('/js/appointments/create.js')}}"></script>
@endsection
