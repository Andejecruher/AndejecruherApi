<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Acción para el login
    public function login(Request $request)
    {
        // Validación de los datos del formulario de inicio de sesión
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intento de autenticación
        if (Auth::attempt($request->only('email', 'password'))) {
            // Usuario autenticado
            $user = Auth::user();

            // Generación del token de acceso con una duración de 15 minutos (900 segundos)
            $accessToken =  $user->createToken('api-token', ['expiration' => now()->addMinutes(15)])->plainTextToken;

            $refreshToken = $user->createToken('refresh-token', ['expiration' => now()->addDays(7)])->plainTextToken;

            // Retornar la respuesta con el token de acceso
            return response()->json([
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'token_type' => 'Bearer',
            ], 200);
        }

        // Error de autenticación
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    // Acción para el registro de usuarios
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generación del token de acceso con una duración de 15 minutos (900 segundos)
        $accessToken =  $user->createToken('api-token', ['expiration' => now()->addMinutes(15)])->plainTextToken;

        $refreshToken = $user->createToken('refresh-token', ['expiration' => now()->addDays(7)])->plainTextToken;

        // Retornar la respuesta con el token de acceso
        return response()->json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'token_type' => 'Bearer',
        ], 200);
    }

    // Acción para refrescar el token de acceso
    public function refreshToken(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required'
        ]);

        $token = $request->user()->tokens()->where('id', $request->refresh_token)->first();

        if (!$token) {
            return response()->json(['message' => 'Token de actualización inválido'], 401);
        }

        $user = $request->user();
        $user->tokens()->where('id', $request->refresh_token)->first()->delete();

        // Generación del token de acceso con una duración de 15 minutos (900 segundos)
        $accessToken =  $user->createToken('api-token', ['expiration' => now()->addMinutes(15)])->plainTextToken;
        $refreshToken = $user->createToken('refresh-token', ['expiration' => now()->addDays(7)])->plainTextToken;
        // Retornar la respuesta con el token de acceso
        return response()->json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'token_type' => 'Bearer',
        ], 200);
    }

    // Acción para enviar correo de recuperación de contraseña
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email', 'url' => 'required|string']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $token = app('auth.password')->createToken($user);


        Mail::to($user->email)->send(new ForgotPassword($user, $token, $request->url));

        return response()->json(['message' => 'Correo de recuperación de contraseña enviado']);
    }

    // Acción para cerrar sesión
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada'], 200);
    }
}
