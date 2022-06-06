@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('mensaje'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  
  <strong>
    {{ Session::get('mensaje') }} 
  </strong> 
</div>  
@endif

<script>
  var alertList = document.querySelectorAll('.alert');
  alertList.forEach(function (alert) {
    new bootstrap.Alert(alert)
  })
</script>



<a class="btn btn-success" href="{{ url ('empleados/create') }}">Regresar al registro</a>
<br><br>
<table class="table table-dark">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>fotos</th>
            <th>Apellido paterno</th>
            <th>Apellido materno</th>
            <th>correo</th>
            <th>acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td>{{$empleado->id}}</td>
            <td>{{$empleado->Nombre}}</td>
            <td><img class="img-thumbnail img-fluid" width="100" src="{{ asset('storage').'/'.$empleado->fotografia }}" alt=""></td>
            <td>{{$empleado->ApellidoPaterno}}</td>
            <td>{{$empleado->ApellidoMaterno}}</td>
            <td>{{$empleado->Correo}}</td>
            <td>
            <a class="btn btn-warning" href="{{ url('/empleados/'.$empleado->id.'/edit') }}">Editar </a>| 
            <form class="d-inline" action="{{ url('/empleados/'.$empleado->id) }}" method="post">
                @csrf
                {{method_field('DELETE')}}
                <input class="btn btn-danger" type="submit" value="Borrar" onclick="return confirm('quieres borrar?')">
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $empleados->links() !!}
</div>
@endsection