<?php

namespace Modules\Productos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductosAliados extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruc_empresa' 
        , 'razon_social' 
        , 'id_prov' 
        , 'id_canton' 
        , 'id_parroquia' 
        , 'direccion' 
        , 'tlf' 
        , 'correo_corp' 
        , 'fecha_aliado'
    ];
    protected $table = 'empresa_aliado';    
    
    protected static function newFactory()
    {
        return \Modules\Productos\Database\factories\ProductosAliadosFactory::new();
    }
}
