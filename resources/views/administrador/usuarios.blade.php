<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
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

    <div class="container">


        <h1 class="mt-4 mb-3">
            JOY Delivery <small>Usuarios</small>
        </h1>
    
        <br><br>
        <h2>Usuarios</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Tipo</th>
                    <th>direccion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario['id'] }}</td>
                        <td>{{ $usuario['nombre'] }}</td>
                        <td>{{ $usuario['username'] }}</td>
                        <td>{{ $usuario['email'] }}</td>
                        <td>{{ $usuario['telefono'] }}</td>                      
                        <td>{{ $usuario['tipo'] }}</td>                      
                        <td>{{ $usuario['direccion'] }}</td>        
                        <td>
                            <a href="{{ route('administrador.eliminarUsuario', $usuario['id']) }}" class="btn btn-danger">Eliminar</a>
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