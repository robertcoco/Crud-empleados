@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/empleados') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('empleados.form',['modo'=>'Crear']);
</form>
</div>
@endsection