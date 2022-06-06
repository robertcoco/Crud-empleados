    @if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
    <ul>    
        @foreach($errors->all() as $error)
        <li> {{$error}}</li>
        @endforeach
    </ul>
    </div>
    @endif
    <h1>{{$modo}} Empleado</h1>
    <div class="form-group">
    <label for="Nombre">Nombre</label>
    <input class="form-control" type="text" name="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre: old('Nombre') }}"  id="Nombre">
    </div>

    <div class="form-group">
    <label for="ApellidoPaterno">ApellidoPaterno</label>
    <input class="form-control" type="text" name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno') }}" id="ApellidoPaterno">
    </div>

    <div class="form-group">
    <label for="ApellidoMaterno">ApellidoMaterno</label>
    <input class="form-control" type="text" name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno') }}" id="ApellidoMaterno">
    </div>


    <div class="form-group">
    <label for="Correo">Correo</label>
    <input class="form-control" type="text" name="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo') }}" id="Correo">
    </div>

    @if(isset($empleado->fotografia))
    <img width="200" src="{{ asset('storage').'/'.$empleado->fotografia }}" alt="">
    @endif

    <div class="form-group">
    <label for="fotografia" >fotografia</label>
    <input class="form-control" type="file" name="fotografia" id=""><br>
    </div>

    <input class="btn btn-success" type="submit" value="{{$modo}} datos">
    <a class="btn btn-primary" href="{{ url ('empleados/') }}">Regresar</a>