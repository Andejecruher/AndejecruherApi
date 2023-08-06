<?php
namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Tag;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $articulos = Articulo::with('tags','comentarios', 'categoria')->latest()->get();
        return response()->json($articulos, 200);
    }

    public function show($id)
    {
        $articulo = Articulo::with('tags','comentarios', 'categoria')->find($id);
        if ($articulo) {
            return response()->json($articulo, 200);
        } else {
            return response()->json(['message' => 'Artículo no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'contenido' => 'required|string',
            'imagen_destacada' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id', // '1,2,3
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Datos inválidos', 'errors' => $validator->errors()], 422);
        }

        $articulo = Articulo::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'contenido' => $request->contenido,
            'imagen_destacada' => $request->imagen_destacada,
            'fecha_publicacion' => now(), // '2021-08-03 05:48:01
            'usuario_id' => auth()->user()->id,
            'categoria_id' => $request->categoria_id,
        ]);

        if ($request->has('tags')) {
            $tags = Tag::find($request->tags);
            $articulo->tags()->attach($tags);
        }

        return response()->json($articulo, 201);
    }

    public function update(Request $request, $id)
    {
        $articulo = Articulo::find($id);
        if (!$articulo) {
            return response()->json(['message' => 'Artículo no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'descripcion' => 'string',
            'contenido' => 'required|string',
            'imagen_destacada' => 'string',
            'categoria_id' => 'exists:categorias,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Datos inválidos', 'errors' => $validator->errors()], 422);
        }

        $articulo->update($request->only(['titulo', 'contenido', 'descripcion', 'imagen_destacada', 'categoria_id']));

        if ($request->has('tags')) {
            $tags = Tag::find($request->tags);
            $articulo->tags()->sync($tags);
        }

        return response()->json($articulo, 200);
    }

    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        if ($articulo) {
            $articulo->tags()->detach();
            $articulo->delete();
            return response()->json(['message' => 'Artículo eliminado'], 200);
        } else {
            return response()->json(['message' => 'Artículo no encontrado'], 404);
        }
    }
}
