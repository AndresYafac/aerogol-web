@extends('layouts.panle')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Deportes</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('deportes/create') }}" class="btn btn-sm btn-success">Nuevo deporte</a>
        </div>
      </div>
    </div>
    <div class="card-body"> 
      @if (session('notification'))
      <div class="alert alert-success" role="alert">
        {{ session('notification') }}
      </div>
      @endif
    </div>
    <div class="table-responsive">
      <!-- Projects table -->
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($deportes as $deportes)
            <th scope="row">
              {{ $deportes->name}}
            </th>
            <td>
              {{ $deportes->description}}
            </td>       
            <td>           
              <form action="{{ url('/deportes/'.$deportes->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  
                  <a href="{{ url('/deportes/'.$deportes->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                  <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
              </form>  
            </td>
          </tr>  
          @endforeach     
        </tbody>
      </table>
    </div>
  </div>
@endsection
