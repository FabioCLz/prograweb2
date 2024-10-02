@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="header" id="header">
          <nav class="nav container">
            <a href="" class="navL">
              <img src="{{ asset('img/memeba.png') }}" alt="" class="navL-img" />
              MEMEBA
            </a>
           
            <div class="navM" id="nav-menu">
              <ul class="navList">
                <li class="navItem">
                  <a href="{{ route('memeba.index') }}" class="navLink active-link"> INICIO </a>
                </li>
                <li class="navItem">
                  <a href="#product" class="navLink"> PRODUCTOS </a>
                </li>
                <li class="navItem">
                 <a href="{{ route('carrito.mostrar') }}" class="navLink">CARRITO</a>
                </li>
                @if(Auth::check())
        <li class="navItem">
            <span class="navLink">{{ session('nombre_completo') }}</span> <!-- Muestra el nombre completo -->
        </li>
        <li class="navItem">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: red; cursor: pointer;">CERRAR SESIÓN</button>

            </form>
        </li>
    @else
        <li class="navItem">
            <a href="{{ route('usuarios.login') }}" class="navLink"> INICIAR SESION </a>
        </li>
        <li class="navItem">
            <a href="{{ route('usuarios.register') }}" class="navLink"> REGISTRO </a>
        </li>
    @endif


              </ul>

              <div class="navclose" id="nav-close">
                <i class="bx bx-x"></i>
              </div>
            </div>

            <div class="navToggle" id="nav-toggle">
              <i class="bx bx-grid-alt"></i>
            </div>
          </nav>
        </header>

    <div style="margin-top: 100px;">
        <div style="display: flex; justify-content: space-between; gap: 20px;">
            <!-- Formulario de Agregar Producto -->
            <form action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}" method="POST" enctype="multipart/form-data" style="flex: 0 0 400px; background-color: #e0f7fa; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                @csrf
                @if(isset($producto))
                    @method('PUT')
                @endif

                <label for="nombre" style="color: #000000; font-weight: bold;">Nombre</label>
                <input type="text" name="nombre" value="{{ isset($producto) ? $producto->nombre : '' }}" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">

                <label for="descripcion" style="color: #000000; font-weight: bold;">Descripción</label>
                <textarea name="descripcion" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">{{ isset($producto) ? $producto->descripcion : '' }}</textarea>

                <label for="precio" style="color: #000000; font-weight: bold;">Precio</label>
<input type="number" name="precio" value="{{ isset($producto) ? $producto->precio : '' }}" step="any" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">


                <label for="imagen" style="color: #000000; font-weight: bold;">Imagen (URL)</label>
                <input type="url" name="imagen" value="{{ isset($producto) ? $producto->imagen : '' }}" placeholder="https://example.com/imagen.jpg" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">

                <label for="requerimientos_pc" style="color: #000000; font-weight: bold;">Requerimientos del PC</label>
                <textarea name="requerimientos_pc" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">{{ isset($producto) ? $producto->requerimientos_pc : '' }}</textarea>

                <label for="categoria" style="color: #000000; font-weight: bold;">Categoría</label>
                <input type="text" name="categoria" value="{{ isset($producto) ? $producto->categoria : '' }}" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">

                <label for="desarrollador" style="color: #000000; font-weight: bold;">Desarrollador</label>
                <input type="text" name="desarrollador" value="{{ isset($producto) ? $producto->desarrollador : '' }}" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">

                <label for="fecha_lanzamiento" style="color: #000000; font-weight: bold;">Fecha de Lanzamiento</label>
                <input type="date" name="fecha_lanzamiento" value="{{ isset($producto) ? $producto->fecha_lanzamiento : '' }}" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">

                <label for="calificacion" style="color: #000000; font-weight: bold;">Calificación</label>
                <input type="number" name="calificacion" step="0.01" value="{{ isset($producto) ? $producto->calificacion : '' }}" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">

                <label for="plataforma" style="color: #000000; font-weight: bold;">Plataforma</label>
                <input type="text" name="plataforma" value="{{ isset($producto) ? $producto->plataforma : '' }}" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #0d47a1; border-radius: 5px;">

                <button type="submit" class="button" style="width: 100%; background-color: #0d47a1; color: white; padding: 12px; border: none; border-radius: 5px; font-weight: bold; font-size: 16px;">Guardar</button>
            </form>

            <!-- Mostrar la lista de productos -->
            <div style="flex: 1; background-color: #f9f9f9; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); max-height: 500px; overflow-y: auto;">
                <h2 style="color: #1e88e5; text-align: center; margin-top: 0;">Lista de Productos</h2>
                <div style="width: 100%; overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                        <thead>
                            <tr>
                                <th style="padding: 10px; border: 1px solid #000000; color: #000000;">Nombre</th>
                                <th style="padding: 10px; border: 1px solid #000000; color: #000000;">Precio</th>
                                <th style="padding: 10px; border: 1px solid #000000; color: #000000;">Imagen</th>
                                <th style="padding: 10px; border: 1px solid #000000; color: #000000;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #000000; color: #000000;">{{ $producto->nombre }}</td>
                                    <td style="padding: 10px; border: 1px solid #000000; color: #000000;">${{ $producto->precio }}</td>
                                    <td style="padding: 10px; border: 1px solid #000000; color: #000000;"><img src="{{ $producto->imagen }}" alt="Imagen" style="max-width: 50px;"></td>
                                    <td style="padding: 10px; border: 1px solid #000000; color: #000000;">
                                        <!-- Botón para editar -->
                                        <a href="{{ route('productos.edit', $producto->id) }}" style="text-decoration: none; background-color: #29b6f6; color: white; padding: 5px 10px; border-radius: 5px; margin-right: 5px;">Editar</a>

                                        <!-- Formulario para eliminar -->
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background-color: #e53935; color: white; padding: 5px 10px; border-radius: 5px;">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection