<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpresaImagen extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruc_empresa' 
        , 'logo'
    ];
    protected $table = 'logo_empresa';
    
    protected static function newFactory()
    {
        return \Modules\Auth\Database\factories\EmpresaImagenFactory::new();
    }

    public function getLogoAttribute( $value )
    {
        return base64_encode( $value );
    }

}
