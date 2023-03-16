@extends('layouts.panle')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Editar campo</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('courts') }}" class="btn btn-sm btn-danger">
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

      <form action="{{ url('courts/'.$court->id) }}" method="POST">
        @csrf
        @method('PUT')
      <div class="form-group">
          <label for="name">Nombre del campo</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $court->name) }}" required>
      </div>
      <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" name="email" class="form-control" value="{{ old('email', $court->email) }}" >
      </div>
      <div class="form-group">
          <label for="phone">Teléfono</label>
          <input type="text" name="phone" class="form-control" value="{{ old('phone', $court->phone) }}" >
      </div>
      <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="text" name="password" class="form-control" value="">
          <p>*Ingrese un valor solo si desea modificar la contraseña.</p>
      </div>
      <div class="form-group">
        <label for="deportes">Deportes</label>
        <select name="deportes[]" id="deportes" class="form-control 
        selectpicker" data-style="btn-primary" multiple title="Seleccione uno o varios deportes">
          @foreach ($deportes as $deporte)
            <option value="{{ $deporte->id }}">{{ $deporte->name }}</option>
            @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">
        Guardar
      </button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
  $(document).ready(() => {
    $('#deportes').selectpicker('val', @json($deporte_ids));
  });
</script>
@endsection
