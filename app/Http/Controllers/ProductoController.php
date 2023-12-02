<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Imports\ProductosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    public function index()
    {
        $data = Producto::all();
        return view('producto', compact('data'));
    }

    public function getProducto(Request $request)
    {
        $producto = Producto::where('codigo', $request->codigoBarra)->first();
         // Convertir el producto a JSON
        $productoJson = json_encode($producto);
        // Devolver la respuesta AJAX
        return response()->json($productoJson);
    }
    public function store(Request $request)
    {
        $request->validate([
            'foto' => ['required'],
            'codigo' => ['required'],
            'producto' => ['required'],
            'categoria' => ['required'],
            'precio' => ['required'],
            'descripcion' => ['required'],
        ],
        [
            'foto.required' => 'El campo Imagen de Producto es obligatorio',
            'codigo.required' => 'El campo Codigo de Producto es obligatorio',
            'producto.required' => 'El campo Nombre de Producto es obligatorio',
            'categoria.required' => 'El campo Categoria es obligatorio',
            'precio.required' => 'El campo Precio es obligatorio',
            'descripcion.required' => 'El campo Descripcion es obligatorio',
        ]);

        $registro = new Producto();
        if ($request->hasFile('foto')) {
            $uploadPath = public_path('/productos');
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $fileName = $name . '.' . $extension;
            $file->move($uploadPath, $fileName);
            $registro->foto = $fileName;
        }
        $registro->codigo = $request->codigo;
        $registro->producto = $request->producto;
        $registro->categoria = $request->categoria;
        $registro->precio = $request->precio;
        $registro->descripcion = $request->descripcion;
        $registro->save();

        return redirect('/productos')->with('success', 'Registro Guardado Exitósamente');

    }

    public function edit($id)
    {
        $data = Producto::find($id);
        return view('edit-producto', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => ['required'],
            'producto' => ['required'],
            'categoria' => ['required'],
            'precio' => ['required'],
            'descripcion' => ['required'],
        ],
        [

            'codigo.required' => 'El campo Codigo de Producto es obligatorio',
            'producto.required' => 'El campo Nombre de Producto es obligatorio',
            'categoria.required' => 'El campo Categoria es obligatorio',
            'precio.required' => 'El campo Precio es obligatorio',
            'descripcion.required' => 'El campo Descripcion es obligatorio',
        ]);

        $registro = Producto::find($id);
        if ($request->hasFile('foto')) {
            $uploadPath = public_path('/products/');
            $file = $request->file('foto');
            $name = $file->getClientOriginalName();
            if ($registro->foto != $name) {
                Storage::disk("public")->delete('/products/'.$registro->foto);
                Storage::disk("public")->delete('/products/'.$name);
            }
            $file->move($uploadPath, $name);
            $registro->foto = $name;
        }
        $registro->codigo = $request->codigo;
        $registro->producto = $request->producto;
        $registro->categoria = $request->categoria;
        $registro->precio = $request->precio;
        $registro->descripcion = $request->descripcion;
        $registro->save();

        return redirect('/productos')->with('success', 'Registro Actualizado Exitósamente');

    }

    public function viewImport()
    {
        return view('importar');
    }
    public function importProduct(Request $request)
    {

        $request->validate([
            'file' => ['required'],
        ],
        [
            'file.required' => 'El Archivo Excel es obligatorio',
        ]);
        Excel::import(new ProductosImport, request()->file('file'));

        return redirect('/productos')->with('success', 'Productos Importados con Éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = Producto::where('id', $id)->count();
        if ($count>0) {
            $data = Producto::where('id', $id)->delete();
            return redirect('/productos')->with('success', 'Registro Eliminado Exitosamente');
        } else {
            return redirect('/productos')->with('danger', 'Problemas para Mostrar el Registro.');
        }
    }
}
