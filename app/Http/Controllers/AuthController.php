<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
   // Login para la App Móvil (retorna Token Bearer)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'account_name' => 'required|string|max:255',
            'password' => 'required|string',
            'role' => 'required|in:admin,aprendiz',
        ]);

        // Buscar en la tabla correspondiente según el rol
        $account = $credentials['role'] === 'admin'
            ? User::where('role', 'admin')->where('name', $credentials['account_name'])->first()
            : Apprentice::where('name', $credentials['account_name'])->first();

        if (!$account) {
            return response()->json([
                'success' => false,
                'message' => 'El nombre no está registrado para el rol seleccionado.'
            ], 404);
        }

        // Obtener o crear el usuario en la tabla users
        $user = User::firstOrCreate(
            ['email' => $account->email],
            [
                'name' => $account->name,
                'password' => Hash::make($credentials['password']),
                'role' => $credentials['role'],
            ]
        );

        // Verificar la contraseña si el usuario ya existía
        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Las credenciales son incorrectas.'
            ], 401);
        }

        $user->update(['role' => $credentials['role']]);

        // Generar Token de acceso para la App Móvil (Sanctum)
        $token = $user->createToken('mobile_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inicio de sesión exitoso.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]
        ], 200);
    }

    // Cerrar sesión en la App Móvil (Revocar Token)
    public function logout(Request $request)
    {
        // Revoca el token actual del usuario en la petición
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cierre de sesión exitoso.'
        ], 200);
    }

    // Obtener datos del usuario autenticado
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ], 200);
    }
}