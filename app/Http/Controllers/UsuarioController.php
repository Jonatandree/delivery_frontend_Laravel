<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{


    
    
    
        public function guardarMetodoPago(Request $request)
        {
            $usuarioId = session('user_id');
            $response = Http::post('http://localhost:8080/carrito/metodopago/guardar', [
                'csv' => $request->input('csv'),
                'fechaVencimiento' => $request->input('fechaVencimiento'),
                'numeroTarjeta' => $request->input('numeroTarjeta'),
                'id_usuario' => $request->input('id_usuario'),
            ]);
            $responseCarritos = Http::get("http://localhost:8080/carrito/{$usuarioId}");
            $carritos = $responseCarritos->json();
        
            $responseTarjetas = Http::get('http://localhost:8080/carrito/metodopago/listar');
            $tarjetas = $responseTarjetas->json();
        
            $responseOrdenes = Http::get("http://localhost:8080/orden/usuario/{$usuarioId}");
            $ordenes = $responseOrdenes->json(); 
    
            $response = Http::get('http://localhost:8080/productos/listar');
            $productos = $response->json();
            return view('productos.catalogo', compact('carritos', 'tarjetas', 'productos', 'ordenes'));
        }
        
        public function mostrarMetodoPago()
        {
            $response = Http::get('http://localhost:8080/carrito/metodopago/listar');
            $tarjetas = $response->json(); 
    
            return view('productos.catalogo', compact('tarjetas'));
        }


    public function home()
    {
        $response = Http::get('http://localhost:8080/productos/listar');
        $productos = $response->json();
        return view('usuarios.home', compact('productos'));
    }

    public function mostrar()
    {
        $response = Http::get('http://localhost:8080/usuarios/listar');
        $usuarios = $response->json(); 
        return view('usuarios.create', compact('usuarios'));
    }

    public function crear(Request $request)
    {
        $response = Http::post('http://localhost:8080/usuarios/guardar', [
            'nombre' => $request->input('nombre'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'tipo' => $request->input('tipo', 'USER'),
            'password' => $request->input('password'),
            'metodopago' => $request->input('metodopago'),
        ]);
        return redirect()->route('usuarios.crear');
    }

    public function ver($id){
        $response = Http::get('http://localhost:8080/usuarios/obtener/'.$id);
        $usuario = $response->json();
        return view('usuarios.update', compact('usuario'));
    }

    public function login(Request $request)
    {
        $response = Http::get('http://localhost:8080/productos/listar');
        $productos = $response->json();
    
        $responseUsuarios = Http::get('http://localhost:8080/usuarios/listar');
        $usuarios = $responseUsuarios->json();
        $usuario = collect($usuarios)->firstWhere('email', $request->input('email'));
    
        if ($usuario && $usuario['password'] === $request->input('password')) {
            session(['username' => $usuario['username']]);
            session(['user_id' => $usuario['id']]);

            $responseTarjetas = Http::get('http://localhost:8080/carrito/metodopago/listar');
            $tarjetas = $responseTarjetas->json(); 
            $carritoResponse = Http::get('http://localhost:8080/carrito/'.$usuario['id']);
            $carritos = $carritoResponse->json();
            $responseOrdenes = Http::get('http://localhost:8080/orden/usuario/'.$usuario['id']);
            $ordenes = $responseOrdenes->json(); 
    
            if ($usuario['tipo'] === 'USER') {
                return view('productos.catalogo', compact('productos', 'carritos', 'tarjetas','ordenes'));
            } elseif ($usuario['tipo'] === 'ADMIN') {
                return view('productos.create', compact('productos'));
            }
        } else {
            return view('usuarios.login', compact('productos'));
        }
    }

    
    public function agregarAlCarrito(Request $request)
    {
        $usuarioId = $request->input('usuarioId');
        $productoId = $request->input('productoId');
        $cantidad = $request->input('cantidad');
        
        $response = Http::post("http://localhost:8080/carrito/agregar?usuarioId={$usuarioId}&productoId={$productoId}&cantidad={$cantidad}");
        
        $responseProductos = Http::get('http://localhost:8080/productos/listar');
        $productos = $responseProductos->json(); 
        
        $responseCarritos = Http::get("http://localhost:8080/carrito/{$usuarioId}");
        $carritos = $responseCarritos->json();
    
        $responseOrdenes = Http::get("http://localhost:8080/orden/usuario/{$usuarioId}");
        $ordenes = $responseOrdenes->json(); 

        $responseTarjetas = Http::get('http://localhost:8080/carrito/metodopago/listar');
        $tarjetas = $responseTarjetas->json();
        return view('productos.catalogo', compact('carritos', 'productos', 'tarjetas', 'ordenes'));
    }
    
    public function eliminarDelCarrito(Request $request)
    {
        $usuarioId = $request->input('usuarioId');
        $productoId = $request->input('productoId');
        
        $response = Http::delete("http://localhost:8080/carrito/eliminar?usuarioId={$usuarioId}&productoId={$productoId}");
        
        $responseProductos = Http::get('http://localhost:8080/productos/listar');
        $productos = $responseProductos->json(); 
        
        $responseCarritos = Http::get("http://localhost:8080/carrito/{$usuarioId}");
        $carritos = $responseCarritos->json();
    
        $responseOrdenes = Http::get("http://localhost:8080/orden/usuario/{$usuarioId}");
        $ordenes = $responseOrdenes->json(); 

        $responseTarjetas = Http::get('http://localhost:8080/carrito/metodopago/listar');
        $tarjetas = $responseTarjetas->json();
        return view('productos.catalogo', compact('carritos', 'productos', 'tarjetas','ordenes'));
    }
    

    public function vaciarCarrito(Request $request)
    {
        $usuarioId = $request->input('usuarioId');
        $response = Http::post("http://localhost:8080/carrito/vaciar?usuarioId={$usuarioId}");

        $responseProductos = Http::get('http://localhost:8080/productos/listar');
        $productos = $responseProductos->json(); 
        
        $responseCarritos = Http::get("http://localhost:8080/carrito/{$usuarioId}");
        $carritos = $responseCarritos->json();
    
        $responseOrdenes = Http::get("http://localhost:8080/orden/usuario/{$usuarioId}");
        $ordenes = $responseOrdenes->json(); 

        $responseTarjetas = Http::get('http://localhost:8080/carrito/metodopago/listar');
        $tarjetas = $responseTarjetas->json();
        return view('productos.catalogo', compact('carritos', 'productos','tarjetas','ordenes'));
    }
    
    public function generarOrden(Request $request)
    {
        $usuarioId = $request->input('usuarioId');
        $xusuario = $request->input('xusuario');
        $yusuario = $request->input('yusuario');
        $metodopagoId = $request->input('metodopagoId');
        
        $response = Http::post("http://localhost:8080/carrito/generarorden?usuarioId={$usuarioId}&xusuario={$xusuario}&yusuario={$yusuario}&metodopagoId={$metodopagoId}");
        $responseCalcularCosto = Http::get("http://localhost:8080/carrito/calcularCosto?xUsuario={$xusuario}&yUsuario={$yusuario}");

        $responseProductos = Http::get('http://localhost:8080/productos/listar');
        $productos = $responseProductos->json(); 
    
        $responseCarritos = Http::get("http://localhost:8080/carrito/{$usuarioId}");
        $carritos = $responseCarritos->json();
    
        $responseOrdenes = Http::get("http://localhost:8080/orden/usuario/{$usuarioId}");
        $ordenes = $responseOrdenes->json(); 

        $responseTarjetas = Http::get('http://localhost:8080/carrito/metodopago/listar');
        $tarjetas = $responseTarjetas->json(); 
    
        return view('productos.catalogo', compact('carritos', 'productos', 'tarjetas','ordenes'));
    }

}