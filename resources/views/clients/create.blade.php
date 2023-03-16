@extends('layouts.panle')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Nuevo cliente</h3>
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

      <form action="{{ url('clients') }}" method="POST">
        @csrf
      <div class="form-group">
          <label for="name">Nombres del cliente</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}">
      </div>
      <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" name="email" class="form-control" value="{{ old('email') }}">
      </div>
      <div class="form-group">
          <label for="phone">Teléfono</label>
          <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
      </div>
      <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="text" name="password" class="form-control" value="{{ str_random(6) }}">
      </div>
      <button type="submit" class="btn btn-primary">
        Guardar
      </button>
      </form>
    </div>
  </div>
@endsection
