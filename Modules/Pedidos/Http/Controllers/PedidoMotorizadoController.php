<?php

namespace Modules\Pedidos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Modules\Pedidos\Entities\Pedido;
use Modules\Pedidos\Entities\DetalleCompra as Detalle;
use Modules\Pedidos\Entities\Factura;
use Modules\Auth\Entities\UserMotorizado;
use PDF;

class PedidoMotorizadoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = Pedido::with(['cliente', 'productos.producto.aliado.imagen'])->whereIn('estado_pedido', ['p', 'r'])->get();

        return response_data( $data, Response::HTTP_OK, 'Datos Leidos correctamente.');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // return view('pedidos::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try
        {
            DB::beginTransaction();

            $motorizado = UserMotorizado::where('ci_empleado', $request->ci_empleado)->first();

            $factura['nro_fact'] = str_pad($request->id_pedido, 8, "0", STR_PAD_LEFT);;
            $factura['fecha_emi'] = now();
            // $factura['id_mt'] = auth()->user()->motorizado->id_mt;
            $factura['id_mt'] = $motorizado->id_mt;
            $factura['id_pedido'] = $request->id_pedido;
            $factura['id_tarifamt'] = $request->id_tarifamt;
            $factura['id_fpago'] = $request->id_fpago;


            $factura = Factura::create( $factura );
            Pedido::where('id_pedido', $request->id_pedido)->update(['estado_pedido' => 'f']);

            $detalle = Detalle::where('id_pedido', $request->id_pedido)->get();
            foreach ($detalle as $key => $value) {
                Detalle::where('id_dtcompra', $value['id_dtcompra'])->update(['estado_compra' => 'f']);
            } 

            $data = Pedido::with(['cliente', 'productos.producto'])->where('id_pedido',$request->id_pedido )->get();             

            DB::commit();
            return response_data( $factura, Response::HTTP_CREATED, 'Pedido creado correctamente');
            
        }
        catch (\Exception $e)
        {
            DB::rollback(); 
            return response_data(null, Response::HTTP_INTERNAL_SERVER_ERROR , 'Error al procesar petici??n.' . $e->getMessage() );
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data = Pedido::with(['cliente', 'productos.producto', 'factura'])->where('id_pedido',$id)->get();

        $subtotal = collect( $data[0]['productos'] )->sum('subtotal'); 
        $iva_valor = collect( $data[0]['productos'] )->sum('iva_valor');
        $total = collect( $data[0]['productos'] )->sum('total');

        $datos = [ 'data' => $data, 'subtotal'  => $subtotal, 'iva' =>  $iva_valor, 'total' => $total  ];

        $pdf = PDF::loadView( 'factura', compact('datos') );
        return $pdf->download('invoice.pdf');        
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('pedidos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        try
        {
            DB::beginTransaction();

            $pedido = Pedido::where('id_pedido', $id)->first();
            $estado = null;
            switch ($pedido->estado_pedido) {
                case 'p':
                    $estado = 'r';
                    break;
                case 'r':
                    $estado = 'f';
                    break;                    
                default:
                    $estado = 'p';
                    break;
            };

            Pedido::where('id_pedido', $id)->update(['estado_pedido' => $estado]);     

            DB::commit();
            return response_data( [
                'pedido' => $pedido
            ], Response::HTTP_CREATED, 'Pedido creado correctamente');
            
        }
        catch (\Exception $e)
        {
            DB::rollback(); 
            return response_data(null, Response::HTTP_INTERNAL_SERVER_ERROR , $e->getMessage() );
        }


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
