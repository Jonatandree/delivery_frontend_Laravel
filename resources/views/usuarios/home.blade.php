<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark"style="background-color: rgb(114, 234, 234)">
		<div class="container">
			<a class="navbar-brand" th:href="@{/administrador}">JOY Delivery</a>
		</div>
	</nav>

	<div class="container"  style="background-color: azure">
		<header class="jumbotron my-4">
			<h1 class="display-3">Bienvenido a JOY Delivery 2023</h1>
			<p class="lead">Tu tienda de productos en Línea</p>
			<br><br>
			<button type="button" class="btn btn-dark"><a style="color: aliceblue; text-decoration: none;"  href="{{ route('usuarios.login') }}">Iniciar Sesion</a></button>
		</header>
	</div>



	<br><br><br>
	<div class="row">
    @foreach ($productos as $producto)
        <div class="col-md-4 mb-4">
            <button type="button" class="btn btn-light shadow-sm" style="width: 250px" data-bs-toggle="modal" data-bs-target="#modal{{ $producto['id'] }}">
                <img src="{{ asset('imagenes/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}" style="max-width: 100px;">
                <h5>{{ $producto['nombre'] }}</h5>
            </button>
            <div class="modal fade" id="modal{{ $producto['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $producto['nombre'] }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('imagenes/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}" style="max-width: 100px;">
                            <p>{{ $producto['descripcion'] }}</p>
                            <p>Precio: Lps.{{ $producto['precio'] }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark"><a style="color: aliceblue; text-decoration: none;"  href="{{ route('usuarios.login') }}">Iniciar Sesion</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
  </div> 
	
	<footer class="navbar navbar-expand-lg navbar-dark bg-dark"style="background-color: rgb(114, 234, 234)">
		<div class="container">
			<p class="m-0 text-center text-white"> Copyright &copy; JOY
                lenguajes 2023</p>
		</div>
	</footer>
	

		


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>
