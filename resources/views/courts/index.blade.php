@extends('layouts.panle')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Campos deportivos</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('courts/create') }}" class="btn btn-sm btn-success">Nuevo campo</a>
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
            <th scope="col">Correo</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($courts as $court)
          <tr>            
            <th scope="row">
              {{ $court->name}}
            </th>
            <td>
              {{ $court->email}}
            </td>       
            <td>           
              <form action="{{ url('/courts/'.$court->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  
                  <a href="{{ url('/courts/'.$court->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
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
