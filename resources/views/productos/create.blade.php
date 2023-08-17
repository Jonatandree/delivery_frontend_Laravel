<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Producto</title>
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
						<li><a class="dropdown-item" href="{{ route('repartidores.crear') }}">Repartidores</a></li>
						<li><a class="dropdown-item" href="{{ route('usuarios.login') }}">Salir</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
<body>
    <br>
    <div class="container" >
        <h1>Crear Producto</h1>

        <form method="POST"  action="{{ route('productos.crear.post') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
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
                <input type="text" name="precio" id="precio" class="form-control" pattern="\d+(\.\d+)?" title="Ingresa un número válido (ej: 10.99)" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="text" name="cantidad" id="cantidad" class="form-control"  pattern="\d+" title="Ingresa un número válido (ej: 200)" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <h2>Listado de Productos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Accion</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto['id'] }}</td>
                        <td>{{ $producto['nombre'] }}</td>
                        <td>{{ $producto['descripcion'] }}</td>
                        <td>
                            <img src="{{ asset('imagenes/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}" style="max-width: 100px;">
                        </td>
                        <td>{{ $producto['precio'] }}</td>
                        <td>{{ $producto['cantidad'] }}</td>
                        <td>
                            <a href="{{ route('productos.ver', $producto['id']) }}" class="btn btn-warning">Modificar</a>
                        </td>
                        <td>
                            <a href="{{ route('productos.eliminar', $producto['id']) }}" class="btn btn-danger">Eliminar</a>
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>
