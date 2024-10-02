@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')

<style>
    /* Agrega aquí tus estilos CSS como antes */
    .carrito {
        padding-top: 2rem;
    }

    .sectiontitle {
        text-align: center;
        margin-bottom: 20px;
        font-size: 2rem;
        color: #1a1a1a;
    }

    .emptycart {
        text-align: center;
        font-size: 1.5rem;
        color: #333;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .cart-table th, .cart-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 1rem;
    }

    .cart-table th {
        background-color: #1a73e8; /* Color azul para los encabezados */
        color: white; /* Color de texto para los encabezados */
    }

    .cart-table td {
        vertical-align: middle; /* Alineación vertical de las celdas */
    }

    .cart-table img {
        vertical-align: middle;
        margin-right: 15px;
    }

    .button-container {
        text-align: center;
        margin-top: 20px;
    }

    .button {
        padding: 10px 20px;
        background-color: #1a73e8; /* Color similar al tema */
        color: white;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1rem;
    }

    .button:hover {
        background-color: #155ab6; /* Un poco más oscuro al pasar el cursor */
    }

    .total-row {
        font-weight: bold; /* Resaltar el total */
        background-color: #1a73e8; /* Color azul igual al de los encabezados */
        color: white; /* Color de texto blanco */
    }
</style>

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

<main class="main">
    <!-- Carrito de Compras -->
    <section class="section carrito" id="carrito">
        <h2 class="sectiontitle">Carrito de Compras</h2>

        @if (empty($carrito))
            <p class="emptycart">No tienes productos en el carrito.</p>
        @else
            <div class="container grid">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
    @php
        $total = 0; // Inicializar total
    @endphp
    @foreach ($carrito as $index => $item) <!-- Agrega el índice para identificar el producto -->
        <tr>
            <td style="vertical-align: middle;">
                <img src="{{ $item['imagen'] }}" alt="{{ $item['nombre'] }}" style="width: 50px; height: auto;">
                <span>{{ $item['nombre'] }}</span>
                <form action="{{ route('carrito.eliminar', $index) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE') <!-- Método para indicar la eliminación -->
                    <button type="submit" class="button" style="background-color: #ff4d4d; margin-left: 10px;">Eliminar</button>
                </form>
            </td>
            <td style="vertical-align: middle;">${{ number_format($item['precio'], 2) }}</td>
            <td style="vertical-align: middle;">
    <form action="{{ route('carrito.actualizar', $index) }}" method="POST" style="display: inline;">
        @csrf
        <!-- Botón para disminuir la cantidad -->
        <button type="submit" name="cantidad" value="{{ $item['cantidad'] - 1 }}" class="button" style="background-color: #ffcc00;" @if($item['cantidad'] <= 1) disabled @endif>-</button>
        <span style="margin: 0 10px;">{{ $item['cantidad'] }}</span>
        <!-- Botón para aumentar la cantidad -->
        <button type="submit" name="cantidad" value="{{ $item['cantidad'] + 1 }}" class="button" style="background-color: #4caf50;">+</button>
    </form>
</td>

        </tr>
        @php
            $total += $item['precio'] * $item['cantidad']; // Calcular total
        @endphp
    @endforeach
</tbody>

                    <tfoot>
                        <tr class="total-row">
                            <td>Total:</td>
                            <td colspan="2">${{ number_format($total, 2) }}</td> <!-- Mostrar total en la columna de precio -->
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="button-container">
    <form action="{{ route('carrito.pagar') }}" method="POST">
        @csrf
        <button type="submit" class="button">Proceder al Pago</button>
    </form>
</div>

        @endif
    </section>
</main>

@endsection
