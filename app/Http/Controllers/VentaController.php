<?php

namespace App\Http\Controllers;

use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getVentas ()
    {
        $ventas = Venta::with(['detalles_venta', 'vendedor'])
                    ->select('id','id_vendedor', 'id_cliente', 'id_sucursal', 'fecha_venta', 'monto_total')
                    ->get();

        $ventas->transform(function ($venta) {
            //Cambia los id's foraneos del cada objeto $venta por atributos de sus tablas relacionadas
            $venta->id_vendedor = $venta->vendedor->nombre_ven .' '. $venta->vendedor->apellido_ven;
            $venta->id_cliente = $venta->cliente->nombre_cliente .' '. $venta->cliente->apellido_cliente;
            $venta->id_sucursal = $venta->sucursal->pais;
            // Eliminar la información del vendedor, cliente y sucursal, que ya no es necesaria
            unset($venta->vendedor);
            unset($venta->cliente);
            unset($venta->sucursal);
            return $venta;
        });
        return response()->json([
            'Ventas' => $ventas,
        ]);
    }

    public function createVenta (Request $request)
    {

        //Intento de realizar el proceso de creación
        try {
            //Validación de los datos del request
            $validatedData = $request->validate([
                'id_vendedor' => 'required|integer|min:1|max:20',
                'id_cliente' => 'required|integer|min:1|max:100',
                'id_sucursal' => 'required|integer|min:1|max:10',
                'fecha_venta' => 'required|date',
                'monto_total' => 'required|numeric|min:1|regex:/^[\d]{0,5}(\.[\d]{1,2})?$/',
            ]);

            //Creación de la venta
            $venta = Venta::create([
                'id_vendedor' => $validatedData['id_vendedor'],
                'id_cliente' => $validatedData['id_cliente'],
                'id_sucursal' => $validatedData['id_sucursal'],
                'fecha_venta' => $validatedData['fecha_venta'],
                'monto_total' => $validatedData['monto_total'],
            ]);

        //De haber datos mal ingresados, muestra un error
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos invalidos',
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 400);
        }


        //Retorna la venta creada. De caso contrario, muestra un error
        if ($venta) {
            return response()->json([
                'message' => 'Venta creada',
                'Venta' => $venta
            ], 201);
        } else {
            return response()->json([
                'message' => 'Venta no creada',
            ], 400);
        }
    }

    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
