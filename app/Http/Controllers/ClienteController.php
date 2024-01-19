<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cliente::all();
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
                'email' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $nuevoCliente = new Cliente();
            $nuevoCliente->nombre = $request->nombre;
            $nuevoCliente->apellidos = $request->apellidos;
            $nuevoCliente->sexo = $request->sexo;
            $nuevoCliente->fecha_nacimiento = $request->fecha_nacimiento;
            $nuevoCliente->tipo_documento = $request->tipo_documento;
            $nuevoCliente->num_documento = $request->num_documento;
            $nuevoCliente->direccion = $request->direccion;
            $nuevoCliente->telefono = $request->telefono;
            $nuevoCliente->email = $request->email;
            $nuevoCliente->save();
            return response()->json([
                'message' => "Cliente Registrado Correctamente."
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
            if (Cliente::find($id)->exists() === false) {
                return response()->json([
                    'message' => "No existe un Cliente con el id N° " . $id
                ]);
            }
            return Cliente::find($id);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
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
                'email' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            if (Cliente::where('id', $id)->exists() === true) {
                $updateCliente = Cliente::find($id);
                $updateCliente->nombre = $request->nombre;
                $updateCliente->apellidos = $request->apellidos;
                $updateCliente->sexo = $request->sexo;
                $updateCliente->fecha_nacimiento = $request->fecha_nacimiento;
                $updateCliente->tipo_documento = $request->tipo_documento;
                $updateCliente->num_documento = $request->num_documento;
                $updateCliente->direccion = $request->direccion;
                $updateCliente->telefono = $request->telefono;
                $updateCliente->email = $request->email;
                $updateCliente->save();
                return "Cliente Actualizado Correctamente.";
            } else {
                return "No existe un Cliente con ese Id.";
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
            $deleteCliente = Cliente::find($id);
            if (Cliente::where('id', $id)->exists() === false) {
                return response()->json([
                    'message' => "No existe el cliente N° " . $id . "."
                ], 404);
            }
            $deleteCliente->delete();
            return response()->json([
                'message' =>  "El cliente N° " . $id . " ha sido eliminado."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
