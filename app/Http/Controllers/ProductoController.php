<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Obtener todos los productos
        $productos = Producto::all();

        // Retornar la vista con los productos
        return view('memeba', compact('productos'));
    }

    public function create()
    {
        return view('productos.create', [
            'productos' => Producto::all() // Asegúrate de pasar los productos a la vista
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'required|url',
        ]);

        Producto::create($request->all());

        // Redirigir a la vista de crear producto con éxito
        return redirect()->route('productos.create')->with('success', 'Producto agregado con éxito.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $productos = Producto::all(); // Obtén la lista de productos para mostrar en la tabla
        return view('productos.create', compact('producto', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'required|url',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        // Redirigir a la vista de crear producto con éxito
        return redirect()->route('productos.create')->with('success', 'Producto actualizado con éxito.');
    }
    public function destroy($id)
    {
        $producto = Producto::find($id);
        
        if ($producto) {
            $producto->delete();
            return redirect()->route('productos.create')->with('success', 'Producto eliminado correctamente.');
        }

        return redirect()->route('productos.create')->with('error', 'Producto no encontrado.');
    }
    public function show($id)
    {
        // Buscar el producto por su ID
        $producto = Producto::find($id);
        
        // Verificar si el producto existe
        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
        }

        // Si tienes un campo que almacena imágenes adicionales, decodifícalo
        // Aquí se asume que tienes un campo llamado 'imagenes' que es un JSON con las URLs
        $producto->extra_imagenes = json_decode($producto->imagenes, true) ?? [];

        // Retornar la vista con el producto
        return view('productos.show', compact('producto'));
    }
    public function generarClave($id)
{
    // Lógica para generar una clave única
    $key = Str::random(16); // Generar una cadena aleatoria de 16 caracteres

    // Guarda la clave en la base de datos o haz cualquier otra lógica necesaria
    $producto = Producto::find($id);
    $producto->clave = $key; // Asegúrate de que la columna `clave` existe en tu tabla
    $producto->save();

    // Puedes devolver la clave al usuario
    return response()->json(['key' => $key]);
}


}
