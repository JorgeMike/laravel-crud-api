<?php

// Paso 3
// Para crear este archivo use el comando
// php artisan make:controller Api/tareaController

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tareaController extends Controller
{
    // Funcion para obetener todas las tareas
    public function index()
    {
        $tareas = Tarea::all();

        return response()->json([
            'data' => $tareas,
            'status' => 200,
        ]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:1000',
            'estado' => 'required|in:activo,inactivo', // Validar que el estado sea activo o inactivo
        ]);

        if ($validador->fails()) {
            return response()->json([
                'msg' => 'Error de validación en los datos',
                'errors' => $validador->errors(),
                'status' => 400,
            ]);
        }

        $tarea = Tarea::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        if (!$tarea) {
            return response()->json([
                'msg' => 'Error al crear la tarea',
                'status' => 500,
            ]);
        }

        return response()->json([
            'msg' => 'Tarea creada correctamente',
            'data' => $tarea,
            'status' => 201,
        ]);
    }

    public function show($id)
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            return response()->json([
                'msg' => 'Tarea no encontrada',
                'status' => 404,
            ]);
        }

        return response()->json([
            'data' => $tarea,
            'status' => 200,
        ]);
    }

    public function destroy($id)
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            return response()->json([
                'msg' => 'Tarea no encontrada',
                'status' => 404,
            ]);
        }

        $tarea->delete();

        return response()->json([
            'msg' => 'Tarea eliminada correctamente',
            'status' => 200,
        ]);
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            return response()->json([
                'msg' => 'Tarea no encontrada',
                'status' => 404,
            ]);
        }

        $validador = Validator::make($request->all(), [
            'nombre' => 'string|max:100',
            'descripcion' => 'string|max:1000',
            'estado' => 'in:activo,inactivo', // Validar que el estado sea activo o inactivo
        ]);

        if ($validador->fails()) {
            return response()->json([
                'msg' => 'Error de validación en los datos',
                'errors' => $validador->errors(),
                'status' => 400,
            ]);
        }

        $tarea->update($request->all());

        return response()->json([
            'msg' => 'Tarea actualizada correctamente',
            'data' => $tarea,
            'status' => 200,
        ]);
    }
}
