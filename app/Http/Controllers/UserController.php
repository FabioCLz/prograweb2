<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Asegúrate de tener esta línea
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showLoginForm()
{
    return view('usuarios.login'); // Asegúrate de que este archivo exista
}

public function showRegisterForm()
    {
        return view('usuarios.register'); // Asegúrate de que esta vista exista
    }
    
    public function register(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'nombre_completo' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
    ]);

    // Crear el usuario
    User::create([
        'nombre_completo' => $request->nombre_completo,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Redirigir o devolver una respuesta
    return redirect()->route('usuarios.login')->with('success', 'Usuario registrado correctamente. Puedes iniciar sesión.');
}


    

    
    


public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Obtener el usuario autenticado
        $user = Auth::user();
        
        // Guardar el nombre completo en la sesión
        session(['nombre_completo' => $user->nombre_completo]);
        
        return redirect()->route('memeba.index'); // Redirige a la pantalla de Memeba
    }

    return back()->with('error', 'Credenciales incorrectas.');
}


public function logout(Request $request)
{
    Auth::logout();
    $request->session()->flush(); // Elimina todos los datos de sesión
    return redirect()->route('memeba.index')->with('success', 'Has cerrado sesión correctamente.');

}

    
}
