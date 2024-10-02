<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; // Asegúrate de importar Str

class CarritoController extends Controller
{
    public function agregarAlCarrito(Request $request, $id)
{
    $producto = Producto::find($id);

    if (!$producto) {
        return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    $carrito = Session::get('carrito', []);

    // Comprobar si el producto ya está en el carrito
    if (isset($carrito[$id])) {
        $carrito[$id]['cantidad'] += 1; // Incrementa la cantidad
    } else {
        // Agregar producto al carrito
        $carrito[$id] = [
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'imagen' => $producto->imagen, // Asegúrate de guardar la imagen
            'cantidad' => 1
        ];
    }

    // Guardar carrito en sesión
    Session::put('carrito', $carrito);

    return response()->json(['message' => 'Producto agregado al carrito']);
}


    public function mostrarCarrito()
    {
        $carrito = Session::get('carrito', []);

        return view('carrito.index', compact('carrito'));
    }
    // En CarritoController.php
    public function procesarPago(Request $request)
    
    {
        // Suponiendo que el carrito se almacena en la sesión
        $carrito = session('carrito', []);
    
        // Crear un array para las claves
        $claves = [];
    
        // Generar claves aleatorias para cada producto en el carrito
        foreach ($carrito as $item) {
            // Generar una clave por cada cantidad de producto
            for ($i = 0; $i < $item['cantidad']; $i++) {
                $claves[] = Str::random(10); // Cambia 10 por la longitud que desees
            }
        }
    
        // Aquí puedes guardar las claves en la base de datos o hacer lo que necesites
    
        return view('pago', ['claves' => $claves]); // Puedes redirigir a una vista de pago
    }
    public function eliminarProducto($index)
{
    $carrito = session('carrito', []);

    // Eliminar el producto del carrito
    if (isset($carrito[$index])) {
        unset($carrito[$index]);
    }

    // Reindexar el carrito
    $carrito = array_values($carrito);
    session(['carrito' => $carrito]);

    return redirect()->route('carrito.mostrar')->with('success', 'Producto eliminado del carrito.');
}
public function actualizar(Request $request, $index)
{
    // Obtener la nueva cantidad desde el formulario
    $nuevaCantidad = $request->input('cantidad');

    // Asegúrate de que la nueva cantidad sea válida (mayor o igual a 1)
    if ($nuevaCantidad < 1) {
        $nuevaCantidad = 1; // No permitir cantidades menores a 1
    }

    // Lógica para actualizar la cantidad en el carrito
    $carrito = session()->get('carrito', []);
    
    if (isset($carrito[$index])) {
        $carrito[$index]['cantidad'] = $nuevaCantidad; // Actualizar la cantidad
        session()->put('carrito', $carrito); // Guardar el carrito actualizado en la sesión
    }

    return redirect()->route('carrito.mostrar'); // Redirigir de nuevo al carrito
}



}
