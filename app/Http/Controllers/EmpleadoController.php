<?php

namespace App\Http\Controllers;

use App\Models\empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {   $datosEmpleado['empleados'] =empleado::paginate(1); 
        return view('empleados.index',$datosEmpleado);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email|',
            'fotografia'=>'required|mimes:jpeg,png,jpg|max:1000'
        ];

        $mensaje = [
            'required'=>'El :attribute es requerido',
            'fotografia.required'=>'La fotografia es requerida'
        ];

        $this->validate($request,$campos,$mensaje);

        $datos = request()->except('_token');

        if($request->hasFile('fotografia')){
            $datos['fotografia'] = $request->file('fotografia')->store('uploads','public');
        }

        empleado::insert($datos);
        return redirect('empleados')->with('mensaje','Empleado agregado'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $empleado = empleado::findOrFail($id);
        return view('empleados.edit',compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos = [
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email|',
        ];

        $mensaje = [
            'required'=>'El :attribute es requerido',
            
        ];
        if($request->hasFile('fotografia')){
            $campos = ['fotografia'=>'required|mimes:jpeg,png,jpg|max:1000'];
            $mensaje = [
                'fotografia.required'=>'La fotografia es requerida'
            ];
        }

        $this->validate($request,$campos,$mensaje);

        $datosNuevos = request()->except(['_token','_method']);
        if($request->hasFile('fotografia')){
            $empleado = empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->fotografia);    
            $datosNuevos['fotografia'] = $request->file('fotografia')->store('uploads','public');
        }
        empleado::where('id','=',$id)->update($datosNuevos);

        $empleado = empleado::findOrFail($id); 
        //return view('empleados.edit',compact('empleado'));
        return redirect('empleados')->with('mensaje','Empleado agregado'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $empleado = empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->fotografia)){
            empleado::destroy($id);
        }
        return redirect('empleados')->with('mensaje','Empleado eliminado con exito'); 
    }
}
