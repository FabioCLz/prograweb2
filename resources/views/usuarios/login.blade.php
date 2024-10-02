<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e7f0ff; /* Color de fondo suave */
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centra el contenido horizontalmente */
        }

        .header {
            background-color: #007bff; /* Color azul */
            padding: 10px;
            color: white;
            width: 100%;
            text-align: center;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navList {
            list-style: none;
            padding: 0;
            display: flex;
        }

        .navItem {
            margin: 0 10px;
        }

        .navLink {
            color: white;
            text-decoration: none;
        }

        .navLink:hover {
            text-decoration: underline;
        }

        h1 {
            color: #003d7a; /* Azul oscuro */
            margin-top: 20px; /* Espacio entre el título y el formulario */
        }

        .form-container {
            background: #ffffff; /* Fondo blanco para el formulario */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px; /* Aumenta el espacio entre el header y el formulario */
            width: 300px; /* Ancho del formulario */
            text-align: center; /* Centra el contenido del formulario */
        }

        input {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #007bff; /* Borde azul */
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #0056b3; /* Azul más oscuro para el botón */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background: #004494; /* Azul aún más oscuro al pasar el cursor */
        }

        p {
            margin-top: 15px;
        }

        .logo {
            max-width: 100px; /* Ajusta el tamaño del logo */
            margin: 20px 0; /* Espacio entre el título y el logo */
        }
    </style>
</head>
<body>
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
                <li class="navItem">
                    <a href="{{ route('usuarios.login') }}" class="navLink"> INICIAR SESION </a>
                </li>
                <li class="navItem">
                    <a href="{{ route('usuarios.register') }}" class="navLink"> REGISTRO </a>
                </li>
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

<div class="form-container">
    <h1>Login</h1>
    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <img src="{{ asset('img/memeba.png') }}" alt="Logo" class="logo"> <!-- Logo dentro del formulario -->

    <form action="{{ route('usuarios.login.submit') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>¿No tienes cuenta? <a href="{{ route('usuarios.register') }}">Regístrate aquí</a></p>
</div>

</body>
</html>
