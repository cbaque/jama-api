<?php

namespace Modules\Productos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductosImagenes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_imgprod' 
        , 'id_prod' 
        , 'imagen_prod' 
    ];
    protected $table = 'imagen_productos';
    
    protected static function newFactory()
    {
        return \Modules\Productos\Database\factories\ProductosImagenesFactory::new();
    }

    public function getImagenProdAttribute( $value )
    {
        return base64_encode( $value );
    }
  
}
