<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver Orden</title>
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
    <div class="container">
        <br><br><br>
        <h1>Detalle Orden</h1>
        <form method="POST" action="{{ route('administrador.asignarPedido') }}">
            @csrf
            <div class="form-group">
                <label for="ordenId">Id:</label>
                <input readonly type="text" name="ordenId" id="ordenId" value="{{$orden['id']}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="numero">No. de Orden:</label>
                <input readonly type="text" name="numero" id="numero" value="{{$orden['numero']}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fechaCreacion">Fecha Creación:</label>
                <input readonly type="text" name="fechaCreacion" id="fechaCreacion" value="{{$orden['fechaCreacion']}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subtotal">Subtotal:</label>
                <input readonly type="text" name="subtotal" id="subtotal" value="{{$orden['subtotal']}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total">Total:</label>
                <input readonly type="text" name="total" id="total" value="{{$orden['total']}}" class="form-control" required>
            </div>

            <br>
            <hr>
            <h1>Asignar Repartidor</h1>
            <br>
            <div class="form-group">
                <label for="repartidorId">Asignar Repartidor:</label>
                <select name="repartidorId" id="repartidorId" class="form-control" required>
                    <option value="">Seleccionar Repartidor</option>
                    @foreach ($repartidoresAdmin as $repartidor)
                        <option value="{{ $repartidor['id'] }}">   {{ $repartidor['id'] }} . {{ $repartidor['nombre'] }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>