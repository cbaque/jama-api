<?php

namespace Modules\Pedidos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pedido'
        ,'fecha_pedido' 
        , 'ci_cliente' 
        , 'estado_pedido' 
    ];
    protected $table = 'pedidos';
    
    public $timestamps = false;

    
    protected static function newFactory()
    {
        return \Modules\Pedidos\Database\factories\PedidoFactory::new();
    }

    public function cliente()
    {
        return $this->hasOne( 'Modules\Pedidos\Entities\Cliente' , 'ci_cliente' , 'ci_cliente' );
    }  

    public function productos()
    {
        return $this->hasMany( 'Modules\Pedidos\Entities\DetalleCompra' , 'id_pedido' , 'id_pedido' );
    } 

    public function factura()
    {
        return $this->hasMany( 'Modules\Pedidos\Entities\Factura' , 'id_pedido' , 'id_pedido' );
    }              
}
