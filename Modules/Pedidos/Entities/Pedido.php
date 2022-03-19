<?php

namespace Modules\Pedidos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_pedido' 
        , 'ci_cliente' 
        , 'estado_pedido' 
    ];
    protected $table = 'pedidos';
    
    public $timestamps = false;

    
    protected static function newFactory()
    {
        return \Modules\Pedidos\Database\factories\PedidoFactory::new();
    }
}
