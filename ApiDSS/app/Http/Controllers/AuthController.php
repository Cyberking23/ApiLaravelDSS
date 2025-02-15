<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validación manual para campos de registro
        if (!$request->has('name') || empty($request->name)) {
            return response()->json(['message' => 'El campo nombre es obligatorio.'], 400);
        }

        if (!$request->has('email') || empty($request->email)) {
            return response()->json(['message' => 'El campo email es obligatorio.'], 400);
        }

        if (!$request->has('password') || empty($request->password)) {
            return response()->json(['message' => 'El campo password es obligatorio.'], 400);
        }

        // Validación utilizando Laravel para los campos restantes
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'Usuario registrado exitosamente'
        ], 201);
    }

    public function login(Request $request)
    {
        // Validación manual para campos de login
        if (!$request->has('email') || empty($request->email)) {
            return response()->json(['message' => 'El campo email es obligatorio.'], 400);
        }

        if (!$request->has('password') || empty($request->password)) {
            return response()->json(['message' => 'El campo password es obligatorio.'], 400);
        }

        // Intentar autenticar al usuario con las credenciales proporcionadas
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'message' => 'Usuario logueado con éxito',
            'token' => $token
        ]);
    }



    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
