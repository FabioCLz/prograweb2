@extends('layouts.app')

@section('title', 'Pago')

@section('content')

<style>
    /* Estilos generales */
    .pago-container {
        padding: 2rem;
        max-width: 800px;
        margin: 0 auto; /* Centra el contenido */
        text-align: center; /* Centra el texto */
        background-color: #f9f9f9; /* Fondo claro */
        border-radius: 10px; /* Bordes redondeados */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    .pago-container h2 {
        font-size: 2rem; /* Tamaño de fuente más grande para el título */
        color: #1a73e8; /* Color del título */
        margin-bottom: 1rem; /* Espaciado inferior */
    }

    .pago-container ul {
        list-style-type: none; /* Elimina viñetas de la lista */
        padding: 0; /* Elimina padding */
    }

    .pago-container li {
        background-color: #e7f3ff; /* Fondo azul claro para los elementos de la lista */
        margin: 0.5rem 0; /* Espaciado entre elementos */
        padding: 10px; /* Padding interno */
        border-radius: 5px; /* Bordes redondeados */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sombra suave */
        color: #333; /* Color del texto de las claves */
        font-weight: bold; /* Hacer el texto más destacado */
    }

    .pago-container p {
        color: #666; /* Color de texto más suave para el mensaje */
    }

    .button {
        display: inline-block; /* Para que el botón tenga padding */
        padding: 10px 20px;
        background-color: #1a73e8; /* Color azul */
        color: white;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1rem;
        margin-top: 1rem; /* Espaciado superior */
    }

    .button:hover {
        background-color: #155ab6; /* Color más oscuro al pasar el cursor */
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
    <section class="pago-container">
        <h2>Claves Generadas</h2>

        @if (!empty($claves))
            <ul>
                @foreach ($claves as $clave)
                    <li>{{ $clave }}</li>
                @endforeach
            </ul>
        @else
            <p>No se generaron claves.</p>
        @endif

        <a href="{{ route('carrito.mostrar') }}" class="button">Volver al Carrito</a>
    </section>
</main>

@endsection
