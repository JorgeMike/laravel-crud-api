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
        // 1. validar la estructura de la informacion recibida
        $validador = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:1000',
            'estado' => 'required|in:activo,inactivo', // Validar que el estado sea activo o inactivo
        ]);

        // 1.1 si no cumple con la estructura arrojar error
        if ($validador->fails()) {
            return response()->json([
                'msg' => 'Error de validación en los datos',
                'errors' => $validador->errors(),
                'status' => 400,
            ]);
        }

        // 2. si cumple la estructura, crear la tarea
        $tarea = Tarea::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        // 3 si la tarea NO se crea con exito arrojar un error
        if (!$tarea) {
            return response()->json([
                'msg' => 'Error al crear la tarea',
                'status' => 500,
            ]);
        }

        // 4. Si se creo se retorna mensaje de exito y la informacion creada
        return response()->json([
            'msg' => 'Tarea creada correctamente',
            'data' => $tarea,
            'status' => 201,
        ]);
    }

    // Buscar tarea por id
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

    // Eliminar tarea por id
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

        // Validar la existencia de la tarea que se quiere editar
        if (!$tarea) {
            return response()->json([
                'msg' => 'Tarea no encontrada',
                'status' => 404,
            ]);
        }

        // Si la tarea existe validamos la informacion que se paso
        $validador = Validator::make($request->all(), [
            'nombre' => 'string|max:100',
            'descripcion' => 'string|max:1000',
            'estado' => 'in:activo,inactivo', // Validar que el estado sea activo o inactivo
        ]);

        // Si algo no cumple se arroja un error
        if ($validador->fails()) {
            return response()->json([
                'msg' => 'Error de validación en los datos',
                'errors' => $validador->errors(),
                'status' => 400,
            ]);
        }

        // Si cumple se actualiza la tarea
        $tarea->update($request->all());

        return response()->json([
            'msg' => 'Tarea actualizada correctamente',
            'data' => $tarea,
            'status' => 200,
        ]);
    }
}
