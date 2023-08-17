<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand">JOY Delivery</a>
    </div>
  </nav>
  <div style="margin-top: 300px" ></div>
  <div class="container">
  <h1>Iniciar Sesion</h1>
    <br>
    <br>
    <form th:action="@{usuarios.login}" method="post">
      @csrf
      <div class="form-group">
        <label for="email"> Email:  </label>      
        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required> 
      </div>
      <br>
      <br>
      <div class="form-group">
        <label for="pwd"> Contraseña:</label>
        <input type="password"  class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>       
      </div>
      <br>
      <br>
      <div class="form-group">
        <div class="col-sm-2">
          <button type="submit" class="btn btn-dark">Ingresar</button>
        </div>      
      </div>    
    </form>
    <br>
    <br>
    <a href="{{ route('usuarios.crear') }}" class="card-link">Si aún no tiene cuenta aqui puede registrarse</a>
  </div>
  <div style="margin-top: 310px" ></div>




		<footer class="py-5 bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white">Copyright &copy; JOY lenguajes 2023</p>
			</div>
		</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>