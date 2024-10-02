<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto - {{ $producto->nombre }}</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        .additional-info {
            margin-top: 10px; /* Espaciado entre el nombre y la información adicional */
        }

        .requirements-list {
            list-style-type: none; /* Sin viñetas */
            padding: 0; /* Sin relleno */
            margin: 0; /* Sin márgenes */
        }

        .requirements-list li {
            margin-bottom: 5px; /* Espaciado entre los requerimientos */
        }

        .rating {
            color: gold; /* Color de las estrellas */
        }
    </style>
</head>
<body>
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
    
    <div class="product-page">
        <div class="product-info-section">
            <div class="image-section">
                <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
            </div>
            <div class="details-section">
                <h1>{{ $producto->nombre }}</h1>
                
                <!-- Información adicional al lado del nombre -->
                <div class="additional-info">
                    <p><strong>Categoría:</strong> {{ $producto->categoria }}</p>
                    <p><strong>Desarrollador:</strong> {{ $producto->desarrollador }}</p>
                    <p><strong>Calificación:</strong> 
                        <span class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $producto->calificacion)
                                    <i class="bx bxs-star"></i> <!-- Estrella llena -->
                                @else
                                    <i class="bx bx-star"></i> <!-- Estrella vacía -->
                                @endif
                            @endfor
                        </span>
                    </p>
                    <p><strong>Requerimientos del PC:</strong></p>
                    <ul class="requirements-list">
                        @foreach (preg_split('/\r\n|\r|\n/', $producto->requerimientos_pc) as $requerimiento)
                            <li>{{ trim($requerimiento) }}</li> <!-- Cada requerimiento se muestra en una nueva línea -->
                        @endforeach
                    </ul>
                </div>
                
                <ul class="badges">
                    <li><span class="badge">Global</span> Se puede activar en Bolivia</li>
                    <li><span class="badge">Steam</span> Se activa en Steam</li>
                    <li><span class="badge">Código Digital</span> Entrega inmediata</li>
                </ul>
                
                <div class="extra-images">
                    @if(isset($producto->extra_imagenes) && is_array($producto->extra_imagenes))
                        @foreach ($producto->extra_imagenes as $imagen)
                            <img src="{{ $imagen }}" alt="Preview">
                        @endforeach
                    @else
                        <p>No hay imágenes adicionales disponibles.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Descripción del producto -->
        <div class="product-description">
            <h2>Descripción del Producto</h2>
            <p>{{ $producto->descripcion }}</p>
        </div>

        <div class="pricing-section">
            <div class="best-offer">
                <p class="offer-title">La Mejor Oferta</p>
                <img src="https://play-lh.googleusercontent.com/S9RfLcnp32m4Kcy1aX-OeKvvkYOXlP8uWYf31tI0As1nZdaaobSt_5i61CLGfIx4vA" alt="Logo de la Tienda" class="store-logo">
                <p class="price">${{ number_format($producto->precio, 2) }}</p>
                <p class="trust-rating">9.54 Excelente valoración</p>
                <button class="buy-btn" onclick="generarClave({{ $producto->id }})">Comprar ahora</button>

                <p class="small-text">No es el precio final</p>
            </div>

            <div class="other-offers">
                <p class="offer-title">Otras Ofertas</p>
                @for ($i = 0; $i < 4; $i++)
                    @php
                        // Generar un precio aleatorio entre el precio de la mejor oferta + 5 y + 15
                        $randomPrice = $producto->precio + rand(5, 15);
                    @endphp
                    <button class="offer-btn">${{ number_format($randomPrice, 2) }} - Comprar ahora</button>
                @endfor
            </div>
        </div>
    </div>
    <script>
    function generarClave(productoId) {
        // Generar una clave aleatoria (16 caracteres alfanuméricos)
        let clave = '';
        const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const longitud = 16;

        for (let i = 0; i < longitud; i++) {
            clave += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        }

        // Mostrar la clave generada al usuario
        alert("Clave generada para el producto: " + clave);

        // Aquí podrías hacer una petición al servidor si deseas registrar la compra, por ejemplo:
        // fetch('/ruta/para/registrar/compra', {
        //     method: 'POST',
        //     body: JSON.stringify({ productoId: productoId, clave: clave }),
        //     headers: { 'Content-Type': 'application/json' }
        // });
    }
</script>

    
    <script src="script.js"></script> <!-- Asegúrate de que la ruta sea correcta -->
</body>
</html>
