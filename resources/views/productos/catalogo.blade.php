<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark"style="background-color: rgb(114, 234, 234)">

		<div class="container">
			<a class="navbar-brand">JOY Delivery</a>
		</div>

		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"  aria-expanded="false">
						USER
					</a>
					<ul class="dropdown-menu" >
						<li><a class="dropdown-item" href="{{ route('usuarios.login') }}">Cerrar Sesion</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
    <br>
    <div class="container">
        @if(session()->has('username'))
            <div class="alert alert-success" role="alert">
                ¡Bienvenido, {{ session('username') }}! Tu ID de usuario es: {{ session('user_id') }}
            </div>
        @endif
    </div>






    <div class="container mt-5">
        <h2>Productos en el carrito</h2>
        <table class="table ">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalAcumulado = 0; // Inicializa el total acumulado
                @endphp

                @foreach ($carritos as $carrito)
                <tr>
                    <td>{{ $carrito['producto']['nombre'] }}</td>
                    <td>{{ $carrito['cantidad'] }}</td>
                    <td>Lps.{{ $carrito['total'] }}</td>
                    <td>
                        <form method="post" action="{{ route('usuario.eliminarDelCarrito') }}">
                            @csrf
                            @method('DELETE') 
                            <input type="hidden" name="usuarioId" value="{{ session('user_id') }}">
                            <input type="hidden" name="productoId" value="{{ $carrito['producto']['id'] }}">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @php
                $totalAcumulado += $carrito['total']; // Agregar el total al total acumulado
                @endphp
                @endforeach
            </tbody>
        </table>
        <p class='shadow p-3 mb-5 bg-body-tertiary rounded' >Total Del Carrito: Lps.{{ $totalAcumulado }}</p>
        <form method="post" action="{{ route('usuario.vaciarCarrito') }}">
            @csrf
            <input type="hidden" name="usuarioId" value="{{ session('user_id') }}">
            <button type="submit" class="btn btn-warning">Vaciar Carrito</button>
        </form>   
        <br>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalGenerarOrden">Generar Orden</button>


        <div class="modal fade" id="modalGenerarOrden" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Generar Orden</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="post" action="{{ route('usuario.generarOrden') }}">
                            @csrf
                            <input type="hidden" name="usuarioId" id="usuarioId" value="{{ session('user_id') }}">
                            <div class="mb-3">
                                <label for="xusuario" class="form-label">Coordenada de X:</label>
                                <input type="text" class="form-control" id="xusuario" name="xusuario" pattern="-?\d+(\.\d+)?" title="Ingresa una coordenada válida (ej: 10.99)" required>
                            </div>
                            <div class="mb-3">
                                <label for="yusuario" class="form-label">Coordenada de Y:</label>
                                <input type="text" class="form-control" id="yusuario" name="yusuario" pattern="-?\d+(\.\d+)?" title="Ingresa una coordenada válida (ej: 10.99)" required>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="form-group">
                                <label for="metodopagoId">Asignar Tarjeta:</label>
                                <br><br>
                                <select name="metodopagoId" id="metodopagoId" class="form-control" required>
                                    <option value="">Seleccionar Tarjeta</option>
                                    @foreach ($tarjetas as $tarjeta)
                                        <option value="{{ $tarjeta['id'] }}">{{ $tarjeta['csv'] }} - {{ $tarjeta['numeroTarjeta'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success">Generar Orden</button>
                        </form>
                        
                        <br><br>

                        <a data-bs-toggle="modal" data-bs-target="#modalGenerarMetodoPago" href="">¿No tienes registrada tu tarjeta? haz click aqui</a>
                    </div>
                </div>
            </div>
        </div>
        


        <div class="modal fade" id="modalGenerarMetodoPago" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Registra tu Tarjeta de Manera Segura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('usuario.guardarMetodoPago') }}">
                            @csrf
                            <input type="hidden" name="id_usuario" id="id_usuario" value="{{ session('user_id') }}">
                            <div class="mb-3">
                                <label for="csv" class="form-label">CSV:</label>
                                <input type="text" class="form-control" id="csv" name="csv" required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaVencimiento" class="form-label">Fecha Vencimiento (MM/AAAA):</label>
                                <input type="text" class="form-control" id="fechaVencimiento" name="fechaVencimiento" pattern="^(0[1-9]|1[0-2])\/\d{4}$" title="Ingresa una fecha válida (MM/AAAA)" required>
                            </div>
                            <div class="mb-3">
                                <label for="numeroTarjeta" class="form-label">Numero Tarjeta:</label>
                                <input type="text" class="form-control" id="numeroTarjeta" name="numeroTarjeta" required>
                            </div>
                            <button type="submit" class="btn btn-success">Crear</button>
                        </form>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <h4>Tarjetas Guardadas</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    
                                    <th>CSV</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>No. de Tarjeta</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tarjetas as $tarjeta)
                                <tr>
                                    
                                    <td>{{ $tarjeta['csv'] }}</td>
                                    <td>{{ $tarjeta['fechaVencimiento'] }}</td>
                                    <td>{{ $tarjeta['numeroTarjeta'] }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>

        <div>
            <br>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVerOrdenes">Ver Órdenes</button>
        </div>
        <div class="modal fade" id="modalVerOrdenes" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Órdenes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2>Tu Listado de Ordenes</h2>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No. de Orden</th>
                                                        <th>Fecha Creacion</th>
                                                        <th>Subtotal</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ordenes as $orden)
                                                        <tr>
                                                            <td>{{ $orden['numero'] }}</td>
                                                            <td>{{ $orden['fechaCreacion'] }}</td>
                                                            <td>{{ $orden['subtotal'] }}</td>
                                                            <td>{{ $orden['total'] }}</td>														  
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <br>
    <hr>
    <div class="container">
        <h1>Catalogo</h1>
        <br>
        <h2>Lo mejor a tu alcance</h2>
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
                                    <form method="post" action="{{ route('usuario.agregarAlCarrito') }}">
                                        @csrf
                                        <input type="hidden"  name="usuarioId" value="{{ session('user_id') }}">
                                        <input type="hidden"  name="productoId" value=" {{ $producto['id'] }} ">
                                        
                                        <div class="mb-3">
                                            <label for="cantidad" class="form-label">Cantidad</label>
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" value="1" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Añadir al Carrito</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>