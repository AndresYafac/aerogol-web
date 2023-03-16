@extends('layouts.panle')

@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Cientes</h3>
        </div>
        <div class="col text-right">
          <a href="{{ url('clients/create') }}" class="btn btn-sm btn-success">Nuevo cliente</a>
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
            <th scope="col">Teléfono</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($clients as $client)
            <th scope="row">
              {{ $client->name}}
            </th>
            <td>
              {{ $client->email}}
            </td>
             <td>
              {{ $client->phone}}
            </td>         
            <td>           
              <form action="{{ url('/clients/'.$client->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  
                  <a href="{{ url('/clients/'.$client->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                  <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
              </form>  
            </td>
          </tr>  
          @endforeach     
        </tbody>
      </table>
    </div>
    <div class="card-body">
        {{ $clients->links()}}
    </div>
  </div>
@endsection
