<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AdministradorController extends Controller
{
    public function verOrden($id) {
        $response = Http::get('http://localhost:8080/orden/obtener/'.$id);
        $orden = $response->json();
        
        $responseRepartidores = Http::get('http://localhost:8080/repartidores/listar');
        $repartidoresAdmin = $responseRepartidores->json();
        
        return view('administrador.verOrden', compact('orden', 'repartidoresAdmin'));
    }

    public function ordenes(){
        $response = Http::get('http://localhost:8080/orden/listar');
        $ordenes = $response->json(); 
        return view('administrador.ordenes', compact('ordenes'));
    }


    public function guardarOrden(Request $request)
    {
        $response = Http::post('http://localhost:8080/orden/guardar', [
            'id' => $request->input('ordenId'),
            'numero' => $request->input('numero'),
            'fechaCreacion' => $request->input('fechaCreacion'),
            'subtotal' => $request->input('subtotal'),
            'total' => $request->input('total'),
            'repartidor_id' => $request->input('repartidor_id'),
            'usuario_id' => $request->input('usuario_id'),
        ]);
        return redirect()->route('administrador.ordenes');
    }

    public function asignarPedido(Request $request)
    {
        $repartidorId = $request->input('repartidorId');
        $ordenId = $request->input('ordenId');
        $response = Http::put("http://localhost:8080/repartidores/asignarpedido?repartidorId={$repartidorId}&ordenId={$ordenId}");
        
        $responseOrden = Http::get('http://localhost:8080/orden/obtener/'.$ordenId);
        $orden = $responseOrden->json();

        $responseRepartidor = Http::get('http://localhost:8080/repartidores/listar');
        $repartidoresAdmin = $responseRepartidor->json();
    
        return view('administrador.verOrden', compact('orden', 'repartidoresAdmin'));
    }







    public function usuarios()
    {
        $response = Http::get('http://localhost:8080/usuarios/listar');
        $usuarios = $response->json(); 
        return view('administrador.usuarios', compact('usuarios'));
        
    }

    public function eliminarUsuario($id){
        $response = Http::delete('http://localhost:8080/usuarios/eliminar/'.$id);
        return redirect()->route('administrador.usuarios');
    }



    public function repartidores(){
        $response = Http::get('http://localhost:8080/repartidores/listar');
        $repartidoresAdmin = $response->json();
        return view('repartidores.create', compact('repartidoresAdmin'));
    }

    public function eliminarRepartidor($id){
        $response = Http::delete('http://localhost:8080/repartidores/eliminar/'.$id);
        return redirect()->route('repartidores.crear');
    }

    public function crearRepartidor(Request $request){
        $response = Http::post('http://localhost:8080/repartidores/crear', [
            'nombre' => $request->input('nombre'),
            'edad' => $request->input('edad'),
            'telefono' => $request->input('telefono'),
        ]);
        if ($response->successful()) {
            return redirect()->route('repartidores.crear')->with('success', 'Producto creado exitosamente.');
        } else {
            return back()->withInput()->withErrors('Error al crear el producto.');
        }
    }
}