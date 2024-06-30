@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-4 mb-4">Catálogo de Productos</h1>

    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('catalogo.index') }}" method="GET" class="form-inline">
                <div class="form-group flex-fill mr-2">

                    <label for="search" class="sr-only">Buscar:</label>
                    <input type="text" name="search" id="search" class="form-control flex-fill" placeholder="Buscar producto..." value="{{ request('search') }}">

                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card filters-card mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-3">Filtros</h4>
                    <form action="{{ route('catalogo.index') }}" method="GET">
                        <div class="form-group">
                            <label for="category">Categoría:</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Todas</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->nombreCategoria }}" {{ request('category') == $categoria->nombreCategoria ? 'selected' : '' }}>{{ $categoria->nombreCategoria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="min_price">Precio Mínimo:</label>
                            <input type="number" name="min_price" id="min_price" class="form-control" value="{{ request('min_price') }}">
                        </div>
                        <div class="form-group">
                            <label for="max_price">Precio Máximo:</label>
                            <input type="number" name="max_price" id="max_price" class="form-control" value="{{ request('max_price') }}">
                        </div>
                        <div class="form-group">
                            <label for="sort_by">Ordenar por:</label>
                            <select name="sort_by" id="sort_by" class="form-control">
                                <option value="nombre" {{ request('sort_by') == 'nombre' ? 'selected' : '' }}>Nombre</option>
                                <option value="precioUnitario" {{ request('sort_by') == 'precioUnitario' ? 'selected' : '' }}>Precio</option>
                                <option value="popularidad" {{ request('sort_by') == 'popularidad' ? 'selected' : '' }}>Popularidad</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort_order">Orden:</label>
                            <select name="sort_order" id="sort_order" class="form-control">
                                <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                                <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descendente</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Aplicar Filtros</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                @foreach($productos as $producto)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ $producto->imagen_url }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="{{ $producto->nombre }}">
                            <div class="card-body">
                                <h6 class="card-title">{{ $producto->nombre }}</h6>
                                <p class="card-text">Cantidad: {{ $producto->stock }}</p>
                                <p class="card-text" style="font-weight: 500;">Precio: S/.{{ $producto->precioUnitario }}</p>
                                <a href="{{ route('catalogo.producto', $producto->idProducto) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection