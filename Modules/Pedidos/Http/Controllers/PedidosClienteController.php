<?php

namespace Modules\Pedidos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\User;
use Modules\Pedidos\Entities\Cliente;
use DB;
use Illuminate\Support\Facades\Auth;
use Modules\Pedidos\Entities\Pedido;
use Modules\Pedidos\Entities\DetalleCompra as Detalle;

class PedidosClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('pedidos::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pedidos::create');
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

            $existe = User::where('ci_cliente', $request->cedula)->first();

            if ( isset( $existe ) ) :
                throw new \ErrorException( 'Cliente ya se encuentra registrado, inicie sesión para continuar' );
            endif;

            $take_cliente = [
                'nombres' 
                , 'apellidos'  
                , 'direccion'  
            ]; 
            $input_cliente = $request->only( $take_cliente );
            $input_cliente['ci_cliente'] = $request->cedula;
            $input_cliente['tlf_celular'] = $request->telefono;
            $input_cliente['correo_cli'] = $request->correo;

            $user = $request->validate([
                'password' => 'required'
            ]);            
            $user['password'] = Hash::make( $request->password );
            $user['name'] = $request->cedula;
            $user['email'] = $request->cedula;
            $user['ci_cliente'] = $request->cedula;


            $cliente = Cliente::create( $input_cliente );
            $user = User::create( $user );

            $detalle = $request->detalle;
            $input['fecha_pedido'] = now();
            $input['ci_cliente'] = $request->cedula;
            $input['estado_pedido'] = 'p';
            
            $pedido = Pedido::create( $input );

            $array_detalle = [];
            foreach ($detalle as $key => $value) {
                $detalle_tmp = new Detalle();
                $detalle_tmp->id_prod = $value['id_producto'];
                $detalle_tmp->id_pedido = $pedido->id;
                $detalle_tmp->cantidad = $value['cantidad'];
                $detalle_tmp->subtotal = $value['subtotal'];
                $detalle_tmp->iva_valor = $value['iva_valor'];
                $detalle_tmp->total = $value['total'];                
                $detalle_tmp->estado_compra = 'p';
                $array_detalle[] = $detalle_tmp->attributesToArray();
            }

            Detalle::insert($array_detalle);            

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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pedidos::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('pedidos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
