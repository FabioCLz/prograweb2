@extends('layouts.app')

@section('title', 'Memeba')

@section('content')
    <!-- Tu contenido existente -->
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />

        <!-- Boxicons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

        <!-- CSS Swiper Bundle -->
        <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
        

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

        <title>MEMEBA</title>
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

        <main class="main">
          <!-- HOME -->
          <section class="home container" id="home">
            <div class="swiper home-swiper">
              <div class="swiper-wrapper">
                <section>
                  <div class="homecont grid">
                    <div class="homedata">
                      <h1 class="hometitle">MEMEBA <br />LOS PRECIOS <br />MAS BAJOS! </h1>
                      <p class="homedes">
                      "Memeba: Donde los juegos son más que un buen precio."
                      </p>
                      
                    </div>

                    <div class="homegroup">
                      <img src="{{ asset('img/memeba.png') }}" alt="" class="homeimg" />
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </section>

          <!-- Categoría -->
          <section class="section category">
            <h2 class="sectiontitle">Los más vendidos</h2>

            <div class="categorycontainer container grid">
              <div class="categorydata">
                <img src="https://products.eneba.games/resized-products/iQnKhzUFz_oq1G-fm0rAJO_0dYd_g29ESxMyrGkNDa4_350x200_1x-0.jpg" alt="" />
                <h3 class="categorytitle">FC 24</h3>
                <p class="categorydescription">
                  Muy piola.
                </p>
              </div>
              <div class="categorydata">
                <img src="https://products.eneba.games/resized-products/qx8Tbt_P4s0CUWhUi0zXERfNW1s7_qGS5WbBO_uVudI_350x200_3x-0.jpeg" alt="" />
                <h3 class="categorytitle">Elden Ring</h3>
                <p class="categorydescription">
                  Muy dificil.
                </p>
              </div>
              <div class="categorydata">
                <img src="https://products.eneba.games/resized-products/68V0osEOLnLPg6ULG3k1ZJyJWLY9_nrE7o-zmNb07io_350x200_3x-0.jpeg" alt="" />
                <h3 class="categorytitle"> Disney Princess: Enchanted Journey</h3>
                <p class="categorydescription">
                  xd?
                </p>
              </div>
            </div>
          </section>
          <!-- Productos -->
          <section class="section product" id="product">
    <h2 class="sectiontitle">Productos</h2>

    <div class="productcontainer container grid">
        @foreach ($productos as $producto)
            <div class="productcontent">
                <a href="{{ route('producto.show', $producto->id) }}">
                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" class="productimg" />
                    <h3 class="producttitle">{{ $producto->nombre }}</h3>
                    <span class="productsubtitle">{{ $producto->categoria }}</span>
                    <span class="productprice">${{ number_format($producto->precio, 2) }}</span>
                </a>
                
                <button class="button productbutton" onclick="agregarAlCarrito({{ $producto->id }})">
                    <i class="bx bx-cart-alt producticon"></i>
                </button>
            </div>
        @endforeach
    </div>
</section>




          <!-- Botón para agregar productos -->
          <div class="add-product-button" style="text-align: center; margin-top: 20px;">
            <a href="{{ route('productos.create') }}" class="button">Agregar Productos</a>
          </div>

          <!-- Newsletter -->
          <section class="section newsletter">
            <div class="newslc container">
              <h2 class="sectiontitle">Noticias</h2>
              <p class="newsld">Proximamente</p>
              <form action="" class="newslf">
                <input type="text" placeholder="Correo" class="newslin" />
                <button class="button2">Subscríbete</button>
              </form>
            </div>
          </section>
        </main>

        <!-- Footer -->
        <footer class="footer section">
          <div class="footercontainer container grid">
            <div class="footercontent">
              <a href="#" class="footerL">
                <img src="{{ asset('img/favicon.png') }}" alt="" class="footerL-img" />
                MEMEBA
              </a>
              <p class="footerdescription">
              "Memeba: Donde los juegos son más que un buen precio."
              </p>
              <div class="footersocial">
                <a href="#" target="_blank" class="footersocial-link">
                  <i class="bx bxl-facebook"></i>
                </a>
                <a href="#" target="_blank" class="footersocial-link">
                  <i class="bx bxl-instagram-alt"></i>
                </a>
                <a href="#" target="_blank" class="footersocial-link">
                  <i class="bx bxl-twitter"></i>
                </a>
              </div>
            </div>

            <div class="footercontent">
              <h3 class="footertitle">Servicios</h3>
              <ul class="footerlinks">
              
              </ul>
            </div>

            <div class="footercontent">
              <h3 class="footertitle">Nosotros</h3>
              <ul class="footerlinks">

              </ul>
            </div>
          </div>
        </footer>

        <!-- Script de Swiper -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@latest/swiper-bundle.min.js"></script>

        <!-- Custom JS -->
        <script src="{{ asset('js/main.js') }}"></script>
        <script>
    function agregarAlCarrito(id) {
        fetch(`/carrito/agregar/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({}),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

        
      </body>
    </html>
@endsection
