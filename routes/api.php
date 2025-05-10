<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\tareaController;

// Obtener todas las tareas
Route::get('/tareas', [tareaController::class, 'index']);

// Crear una nueva tarea
Route::post('/tareas', [tareaController::class, 'store']);

// Obtener una tarea por ID
Route::get('/tareas/{id}', [tareaController::class, 'show']);

// Eliminar una tarea por ID
Route::delete('/tareas/{id}', [tareaController::class, 'destroy']);

// Actualizar una tarea completa por ID
Route::put('/tareas/{id}', [tareaController::class, 'update']);
