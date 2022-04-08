<?php

namespace Modules\Pedidos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro_fact'
        ,'fecha_emi' 
        , 'id_mt' 
        , 'id_pedido' 
        , 'id_tarifamt' 
        , 'id_fpago' 

    ];
    protected $table = 'factura';
    
    public $timestamps = false;
    
    protected static function newFactory()
    {
        return \Modules\Pedidos\Database\factories\FacturaFactory::new();
    }
}
