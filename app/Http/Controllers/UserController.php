<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('articulos');
        // Aplicar filtros de búsqueda si se proporcionan en la consulta
        if ($request->has('name')) {
            $users->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('email')) {
            $users->where('email', 'like', '%' . $request->input('email') . '%');
        }
        $itemsPorPagina = $request->input('per_page', 10);
        $paginaActual = $request->input('current_page', 1);
        $data = $users->paginate($itemsPorPagina, ['*'], 'page', $paginaActual);
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado'], 200);
    }
    // Otros métodos del controlador según las necesidades.
}
