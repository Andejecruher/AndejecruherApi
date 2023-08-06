<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoAndejecruher;
use App\Mail\CorreoFormContacAndejecruher;

class EmailsController extends Controller
{
    public function enviarMensaje(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'correo' => 'required|string',
            'mensaje' => 'required|string',
        ]);

        // Enviar notificación por correo electrónico
        Mail::to('andejecruher@gmail.com')->send(new CorreoFormContacAndejecruher($request->nombre, $request->correo, $request->mensaje));
        Mail::to($request->correo)->send(new CorreoAndejecruher($request->nombre, $request->mensaje));

        return response()->json(['message' => 'Mensaje enviado correctamente'], 200);
    }
}


