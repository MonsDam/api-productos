<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

use Illuminate\Support\Facades\DB;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $prodcutos = DB::select('select p.id, p.nombre, p.descripcion, p.precio, p.imagen, p.categoria_id, p.proveedor_id, p.created_at, p.updated_at,
        c.nombre as categoria, pr.nombre as proveedor from productos p inner join categorias
        c on p.categoria_id = c.id inner join proveedores 
        pr on p.proveedor_id = pr.id order by p.id desc');
        return response() -> json($prodcutos, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = Producto::create($request->all());
        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        $categoria = DB::select('select c.nombre from productos p inner join categorias c on p.categoria_id = c.id where p.id = ?', [$producto->id]);
        $producto->categoria = $categoria[0]->nombre;
        $proveedor = DB::select('select p.nombre from productos p inner join proveedores pr on p.proveedor_id = pr.id where p.id = ?', [$producto->id]);
        $producto->proveedor = $proveedor[0]->nombre;
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->update($request->all());
        return response()->json($producto, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json(null, 204);
    }
}
