<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;



class ProductoController extends Controller
{

    public function mostrar()
    {
        $response = Http::get('http://localhost:8080/productos/listar');
        $productos = $response->json(); 

        return view('productos.create', compact('productos'));
    }

    public function catalogo()
    {
        $response = Http::get('http://localhost:8080/productos/listar');
        $productos = $response->json(); 

        return view('productos.catalogo', compact('productos'));
    }

    public function crear(Request $request)
    {
    


        $response = Http::post('http://localhost:8080/productos/guardar', [
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'imagen' => $request->input('imagen'),
            'precio' => $request->input('precio'),
            'cantidad' => $request->input('cantidad'),
            'usuario_id' => $request->input('usuario_id'),
        ]);
    
        if ($response->successful()) {
            return redirect()->route('productos.crear')->with('success', 'Producto creado exitosamente.');
        } else {
            return back()->withInput()->withErrors('Error al crear el producto.');
        }
    }

    public function eliminar($id){
        $response = Http::delete('http://localhost:8080/productos/eliminar/'.$id);
        return redirect()->route('productos.crear');
    }

    public function ver($id){
        $response = Http::get('http://localhost:8080/productos/obtener/'.$id);
        $producto = $response->json();
        return view('productos.update', compact('producto'));
    }

    public function modificar(Request $request){
        $response = Http::put('http://localhost:8080/productos/editar', [
            'id'=>$request->input('id'),
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'imagen' => $request->input('imagen'),
            'precio' => $request->input('precio'),
            'cantidad' => $request->input('cantidad'),
            'usuario_id' => $request->input('usuario_id'),
        ]);

        return redirect()->route('productos.crear');
    }





}


