<?php

namespace App\Http\Controllers;

use App\Models\Trabajadore;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrabajadoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Trabajadore::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string',
                'apellidos' => 'required|string',
                'sexo' => 'required|string',
                'fecha_nacimiento' => 'required',
                'tipo_documento' => 'required|string',
                'num_documento' => 'required|max:9',
                'direccion' => 'required|string',
                'telefono' => 'required|string',
                'email' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $nuevoTrabajadore = new Trabajadore();
            $nuevoTrabajadore->nombre = $request->nombre;
            $nuevoTrabajadore->apellidos = $request->apellidos;
            $nuevoTrabajadore->sexo = $request->sexo;
            $nuevoTrabajadore->fecha_nacimiento = $request->fecha_nacimiento;
            $nuevoTrabajadore->tipo_documento = $request->tipo_documento;
            $nuevoTrabajadore->num_documento = $request->num_documento;
            $nuevoTrabajadore->direccion = $request->direccion;
            $nuevoTrabajadore->telefono = $request->telefono;
            $nuevoTrabajadore->email = $request->email;
            $nuevoTrabajadore->save();
            return response()->json([
                'message' =>  "Trabajador Registrado Correctamente."
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            if (Trabajadore::where('id', $id)->exists() === true) {
                return response()->json([
                    'message' =>  "No existe un Trabajador con el id N° " . $id
                ], 404);
            }
            return Trabajadore::find($id);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trabajadore $trabajadore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string',
                'apellidos' => 'required|string',
                'sexo' => 'required|string',
                'fecha_nacimiento' => 'required',
                'tipo_documento' => 'required|string',
                'num_documento' => 'required|max:9',
                'direccion' => 'required|string',
                'telefono' => 'required|string',
                'email' => 'required',
            ]);


            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            if (Trabajadore::where('id', $id)->exists() === true) {
                $updateTrabajadore = Trabajadore::find($id);
                $updateTrabajadore->nombre = $request->nombre;
                $updateTrabajadore->apellidos = $request->apellidos;
                $updateTrabajadore->sexo = $request->sexo;
                $updateTrabajadore->fecha_nacimiento = $request->fecha_nacimiento;
                $updateTrabajadore->tipo_documento = $request->tipo_documento;
                $updateTrabajadore->num_documento = $request->num_documento;
                $updateTrabajadore->direccion = $request->direccion;
                $updateTrabajadore->telefono = $request->telefono;
                $updateTrabajadore->email = $request->email;
                $updateTrabajadore->save();
                return response()->json([
                    'message' => "Trabajadore Actualizado Correctamente."
                ], 200);
            } else {
                return response()->json([
                    'message' => "No existe un Trabajador con ese Id: " . $id
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $deleteTrabajador = Trabajadore::find($id);
            if (Trabajadore::where('id', $id)->exists() === false) {
                return response()->json([
                    'message' =>  "No existe el Trabajador N° " . $id . "."
                ], 404);
            }
            $deleteTrabajador->delete();
            return response()->json([
                'message' =>   "El Trabajador N° " . $id . " ha sido eliminado."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
