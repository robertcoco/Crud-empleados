@extends('layouts.app')
@section('content')
<div class="container">

<form action="{{ url('/empleados/'.$empleado->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('empleados.form',['modo'=>'Editar'])
</form>
</div>
@endsection