<?php

namespace Modules\Pedidos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_dtcompra'
        ,'id_prod' 
        , 'id_pedido' 
        , 'cantidad' 
        , 'subtotal' 
        , 'iva_valor' 
        , 'total' 
        , 'estado_compra' 
    ];
    protected $table = 'detalle_compra';

    public $timestamps = false;
    
    protected static function newFactory()
    {
        return \Modules\Pedidos\Database\factories\DetalleCompraFactory::new();
    }

    public function producto()
    {
        return $this->hasOne( 'Modules\Productos\Entities\Productos' , 'id_prod' , 'id_prod' );
    }      
}
