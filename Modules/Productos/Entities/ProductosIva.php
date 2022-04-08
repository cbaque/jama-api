<?php

namespace Modules\Productos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductosIva extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_vIva' 
        , 'valor' 
    ];
    protected $table = 'valor_iva';
    
    protected static function newFactory()
    {
        return \Modules\Productos\Database\factories\ProductosIvaFactory::new();
    }
}
