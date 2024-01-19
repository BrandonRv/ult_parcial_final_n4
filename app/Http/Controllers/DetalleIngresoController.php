<?php

namespace App\Http\Controllers;

use App\Models\DetalleIngreso;
use App\Models\DetalleVenta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetalleIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DetalleVenta::all();
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
                'id_venta' => 'required',
                'id_articulo' => 'required',
                'cantidad' => 'required',
                'precio_compra' => 'required|string',
                'descuento' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $nuevoDetalleIngreso = new DetalleIngreso();
            $nuevoDetalleIngreso->id_venta = $request->id_venta;
            $nuevoDetalleIngreso->id_articulo = $request->id_articulo;
            $nuevoDetalleIngreso->cantidad = $request->cantidad;
            $nuevoDetalleIngreso->precio_compra = $request->precio_compra;
            $nuevoDetalleIngreso->descuento = $request->descuento;
            $nuevoDetalleIngreso->save();
            return response()->json([
                'message' =>  "El Detalle de Ingreso Registrado Correctamente."
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
            if (DetalleIngreso::where('id', $id)->exists() === false) {
                return response()->json([
                    'message' =>  "No existe un Detalle de Ingreso con el id N° " . $id
                ], 200);
            }
            return DetalleIngreso::find($id);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleIngreso $detalleIngreso)
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
                'id_venta' => 'required',
                'id_articulo' => 'required',
                'cantidad' => 'required',
                'precio_compra' => 'required|string',
                'descuento' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            if (DetalleIngreso::where('id', $id)->exists() === true) {
                $updateDetalleIngreso = DetalleIngreso::find($id);
                $updateDetalleIngreso->id_venta = $request->id_venta;
                $updateDetalleIngreso->id_articulo = $request->id_articulo;
                $updateDetalleIngreso->cantidad = $request->cantidad;
                $updateDetalleIngreso->precio_compra = $request->precio_compra;
                $updateDetalleIngreso->descuento = $request->descuento;
                $updateDetalleIngreso->save();
                return response()->json([
                    'message' =>  "DetalleIngreso Actualizado Correctamente."
                ], 404);
            } else {
                return response()->json([
                    'message' =>   "No existe un DetalleIngreso con ese Id."
                ], 200);
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
            $deleteDetalleIngreso = DetalleIngreso::find($id);
            if (DetalleIngreso::where('id', $id)->exists() === false) {
                return response()->json([
                    'message' =>   "No existe el Detalle de Ingreso N° " . $id . "."
                ], 404);
            }
            $deleteDetalleIngreso->delete();
            return response()->json([
                'message' =>  "El Detalle de Ingreso N° " . $id . " ha sido eliminado."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
