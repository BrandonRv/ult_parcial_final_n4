<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetalleVentaController extends Controller
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
                'precio_venta' => 'required|string',
                'descuento' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $nuevoDetalleVenta = new DetalleVenta();
            $nuevoDetalleVenta->id_venta = $request->id_venta;
            $nuevoDetalleVenta->id_articulo = $request->id_articulo;
            $nuevoDetalleVenta->cantidad = $request->cantidad;
            $nuevoDetalleVenta->precio_venta = $request->precio_venta;
            $nuevoDetalleVenta->descuento = $request->descuento;
            $nuevoDetalleVenta->save();
            return response()->json([
                'message' => "Los Detalles de la Venta se ha Registrado Correctamente."
            ], 404);
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
            if (DetalleVenta::where('id', $id)->exists() === false) {
                return "No existe el detalle de venta con el id N° " . $id;
            }
            return DetalleVenta::find($id);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleVenta $detalleVenta)
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
                'precio_venta' => 'required|string',
                'descuento' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            if (DetalleVenta::where('id', $id)->exists() === true) {
                $updateDetalleVenta = DetalleVenta::find($id);
                $updateDetalleVenta->id_venta = $request->id_venta;
                $updateDetalleVenta->id_articulo = $request->id_articulo;
                $updateDetalleVenta->cantidad = $request->cantidad;
                $updateDetalleVenta->precio_venta = $request->precio_venta;
                $updateDetalleVenta->descuento = $request->descuento;
                $updateDetalleVenta->save();
                return response()->json([
                    'message' =>   "los Detalles de la Venta Actualizado Correctamente."
                ], 200);
            } else {
                return response()->json([
                    'message' =>    "No existe los Detalles de Venta con ese Id."
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
            $deleteDetalleVenta = DetalleVenta::find($id);
            if (DetalleVenta::where('id', $id)->exists() === false) {
                return response()->json([
                    'message' =>   "No existe los Detalles de la Venta N° " . $id . "."
                ], 404);
            }
            $deleteDetalleVenta->delete();
            return response()->json([
                'message' =>  "Los Detalles de la Venta N° " . $id . " ha sido eliminado."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
