<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Trabajadore;
use App\Models\Venta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Venta::all();
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
                'id_cliente' => 'required',
                'id_trabajador' => 'required',
                'fecha' => 'required|string',
                'tipo_comprobante' => 'required|string',
                'correlativo' => 'required|string',
                'igv' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $nuevoVenta = new Venta();
            $nuevoVenta->id_cliente = $request->id_cliente;
            $nuevoVenta->id_trabajador = $request->id_trabajador;
            $nuevoVenta->fecha = $request->fecha;
            $nuevoVenta->tipo_comprobante = $request->tipo_comprobante;
            $nuevoVenta->igv = $request->igv;
            $nuevoVenta->estado = 1;
            $nuevoVenta->save();
            return response()->json([
                'message' =>  "Venta Registrado Correctamente."
            ], 200);
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
            if (Venta::where('id', $id)->exists() === false) {
                return response()->json([
                    'message' =>  "No existe un Venta con el id N° " . $id
                ], 404);
            }
            return Venta::find($id);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
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
                'id_cliente' => 'required',
                'id_trabajador' => 'required',
                'fecha' => 'required|string',
                'tipo_comprobante' => 'required|string',
                'igv' => 'required',
                'correlativo' => 'required|string',
                'estado' => 'required|max:1',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            if (Venta::where('id', $id)->exists() === true) {
                $updateVenta = Venta::find($id);
                $updateVenta->id_trabajador = $request->id_trabajador;
                $updateVenta->fecha = $request->fecha;
                $updateVenta->tipo_comprobante = $request->tipo_comprobante;
                $updateVenta->igv = $request->igv;
                $updateVenta->tipo = $request->tipo;
                if ($request->estado === 1 || $request->estado === 0) {
                    $updateVenta->estado = $request->estado;
                } else {
                    return response()->json([
                        'message' =>  "'Estado' solo acepta los valores 0 o 1."
                    ], 400);
                }
                $updateVenta->save();
                return response()->json([
                    'message' => "Venta Actualizado Correctamente."
                ], 201);
            } else {
                return response()->json([
                    'message' => "No existe una Venta con ese Id."
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
            $deleteventa = Venta::find($id);
            if (Venta::where('id', $id)->exists() === false) {
                return response()->json([
                    'message' =>  "No existe el venta N° " . $id . "."
                ], 404);
            }
            $deleteventa->delete();
            return response()->json([
                'message' =>  "La venta N° " . $id . " ha sido eliminado."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
