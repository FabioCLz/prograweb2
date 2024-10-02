@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <h2>Lista de Productos</h2>
    <div class="productcontainer container grid">
        @foreach($productos as $producto)
            <div class="productcontent">
                <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" class="productimg" />
                <h3 class="producttitle">{{ $producto->nombre }}</h3>
                <span class="productsubtitle">{{ $producto->descripcion }}</span>
                <span class="productprice">${{ $producto->precio }}</span>
                <button class="button productbutton">
                    <i class="bx bx-cart-alt producticon"></i>
                </button>
            </div>
        @endforeach
    </div>
@endsection
