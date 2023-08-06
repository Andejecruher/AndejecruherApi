<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags, 200);
    }

    public function show($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            return response()->json($tag, 200);
        } else {
            return response()->json(['message' => 'Etiqueta no encontrada'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|unique:tags,nombre',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Datos inválidos', 'errors' => $validator->errors()], 422);
        }

        $tag = Tag::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json($tag, 201);
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return response()->json(['message' => 'Etiqueta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'string|unique:tags,nombre,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Datos inválidos', 'errors' => $validator->errors()], 422);
        }

        $tag->nombre = $request->nombre;
        $tag->save();

        return response()->json($tag, 200);
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            return response()->json(['message' => 'Etiqueta eliminada'], 200);
        } else {
            return response()->json(['message' => 'Etiqueta no encontrada'], 404);
        }
    }
}

