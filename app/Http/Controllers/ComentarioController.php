<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $comentarios = Comentario::with('user')->paginate();
        return response()->json($comentarios, 200);
    }

    public function show($id)
    {
        $comentario = Comentario::find($id);
        if ($comentario) {
            return response()->json($comentario, 200);
        } else {
            return response()->json(['message' => 'Comentario no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contenido' => 'required|string',
            'articulo_id' => 'required|exists:articulos,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Datos inválidos', 'errors' => $validator->errors()], 422);
        }

        $comentario = Comentario::create([
            'contenido' => $request->contenido,
            'articulo_id' => $request->articulo_id,
            'nombre_autor' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'ip_address' => $request->ip(),
        ]);

        return response()->json($comentario, 201);
    }

    public function update(Request $request, $id)
    {
        $comentario = Comentario::find($id);
        if (!$comentario) {
            return response()->json(['message' => 'Comentario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'contenido' => 'string',
            'articulo_id' => 'exists:articulos,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Datos inválidos', 'errors' => $validator->errors()], 422);
        }

        $comentario->update($request->only(['contenido', 'articulo_id']));

        return response()->json($comentario, 200);
    }

    public function destroy($id)
    {
        $comentario = Comentario::find($id);
        if ($comentario) {
            $comentario->delete();
            return response()->json(['message' => 'Comentario eliminado'], 200);
        } else {
            return response()->json(['message' => 'Comentario no encontrado'], 404);
        }
    }
}

