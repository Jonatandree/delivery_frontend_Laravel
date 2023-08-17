<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark"style="background-color: rgb(114, 234, 234)">

		<div class="container">
			<a class="navbar-brand" th:href="@{/administrador}">JOY Delivery</a>
		</div>

		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"  aria-expanded="false">
						ADMIN
					</a>
					<ul class="dropdown-menu" >
						<li> <a class="dropdown-item" href="{{ route('productos.crear') }}">Productos</a></li>
						<li><a class="dropdown-item" href="{{ route('administrador.usuarios') }}">Usuarios</a></li>
						<li><a class="dropdown-item" href="{{ route('administrador.ordenes') }}">Ordenes</a></li>
						<li><a class="dropdown-item" href="{{ route('usuario.login') }}">Salir</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
<body>
    <div class="container">
        <h1>Modificar Producto</h1>

        <form method="POST" action="{{ route('productos.modificar') }}">
            @csrf
            <div class="form-group">
                <label for="id">Id:</label>
                <input readonly type="text" name="id" id="id" value="{{$producto['id']}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="{{$producto['nombre']}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <input type="text" name="descripcion" id="descripcion" value="{{$producto['descripcion']}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <select class="form-control" name="imagen" id="imagen" required>
                    <option value="">Selecciona una imagen</option>
                    @foreach (File::files(public_path('imagenes')) as $image)
                        <option value="{{ basename($image) }}">{{ basename($image) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="text" name="precio" id="precio" value="{{$producto['precio']}}" class="form-control" pattern="\d+(\.\d+)?" title="Ingresa un número válido (ej: 10.99)" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="text" name="cantidad" id="cantidad" value="{{$producto['cantidad']}}" class="form-control"  pattern="\d+" title="Ingresa un número válido (ej: 200)" required>
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>