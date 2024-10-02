<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <main>
        @yield('content')  <!-- Aquí es donde se inyectará el contenido de las vistas -->
    </main>

</body>
</html>
