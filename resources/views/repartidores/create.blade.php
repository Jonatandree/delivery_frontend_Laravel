<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Repartidores</title>
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
        <h1>Crear Repartidor</h1>

        <form method="POST"  action="{{ route('repartidores.crear.post') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="text" name="edad" id="edad" class="form-control"  pattern="\d+" title="Ingresa un número válido (ej: 200)" required>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="text" name="telefono" id="telefono" class="form-control"  pattern="\d+" title="Ingresa un número válido (ej: 200)" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <h2>Listado de Repartidores</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Telefono</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($repartidoresAdmin as $repartidor)
                    <tr>
                        <td>{{ $repartidor['id'] }}</td>
                        <td>{{ $repartidor['nombre'] }}</td>
                        <td>{{ $repartidor['edad'] }}</td>
                        <td>{{ $repartidor['telefono'] }}</td>
                        <td>
                            <a href="{{ route('repartidores.eliminar', $repartidor['id']) }}" class="btn btn-danger">Eliminar</a>
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; JOY lenguajes 2023</p>
		</div>
	</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>
