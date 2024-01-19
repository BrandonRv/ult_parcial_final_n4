<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Articulo::all();
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
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'description' => 'required|string',
                'stock_inicial' => 'required|string',
                'stock_actual' => 'required|string',
                'encargado' => 'required',
                'pedidos' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $nuevoArticulo = new Articulo();
            $nuevoArticulo->codigo = $request->codigo;
            $nuevoArticulo->nombre = $request->nombre;
            $nuevoArticulo->description = $request->description;
            $nuevoArticulo->stock_inicial = $request->stock_inicial;
            $nuevoArticulo->stock_actual = $request->stock_actual;
            $nuevoArticulo->encargado = $request->encargado;
            $nuevoArticulo->pedidos = $request->pedidos;
            $nuevoArticulo->save();
            return response()->json([
                'message' => "Articulo Registrado Correctamente."
            ], 201);
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
            if (Articulo::find($id) == null) {
                return response()->json([
                    'message' => "No existe un Articulo con el id N° " . $id
                ], 404);
            }
            return Articulo::find($id);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulo $articulo)
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
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'description' => 'required|string',
                'stock_inicial' => 'required|string',
                'stock_actual' => 'required|string',
                'encargado' => 'required',
                'pedidos' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            if (Articulo::where('id', $id)->exists() === true) {
                $updateArticulo = Articulo::find($id);
                $updateArticulo->codigo = $request->codigo;
                $updateArticulo->nombre = $request->nombre;
                $updateArticulo->description = $request->description;
                $updateArticulo->stock_inicial = $request->stock_inicial;
                $updateArticulo->stock_actual = $request->stock_actual;
                $updateArticulo->encargado = $request->encargado;
                $updateArticulo->pedidos = $request->pedidos;
                $updateArticulo->save();
                return response()->json([
                    'message' => "Articulo Actualizado Correctamente."
                ], 200);
            } else {
                return response()->json([
                    'message' => "No existe un Articulo con ese Id."
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
            $deleteArticulo = Articulo::find($id);
            if (Articulo::where('id', $id)->exists() === false) {
                return response()->json([
                    'message' => "No existe el Articulo N° " . $id . "."
                ], 404);
            }
            $deleteArticulo->delete();
            return response()->json([
                'message' => "El Articulo N° " . $id . " ha sido eliminado."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
