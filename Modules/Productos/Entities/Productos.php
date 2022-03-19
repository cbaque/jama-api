<?php

namespace Modules\Productos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_prod' 
        , 'ruc_empresa' 
        , 'titulo_prod' 
        , 'descripcion' 
        , 'costo' 
        , 'iva' 
        , 'id_estado' 
        , 'fecha_publicidad' 
        , 'id_tpubli'
    ];
    protected $table = 'productos';
    
    protected static function newFactory()
    {
        return \Modules\Productos\Database\factories\ProductosFactory::new();
    }

    public function imagen()
    {
        return $this->hasOne( 'Modules\Productos\Entities\ProductosImagenes' , 'id_prod' , 'id_prod' );
    } 

    public function aliado()
    {
        return $this->hasOne( 'Modules\Productos\Entities\ProductosAliados' , 'ruc_empresa' , 'ruc_empresa' );
    }           
}
