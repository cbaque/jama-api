<?php

namespace Modules\Pedidos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci_cliente' 
        , 'nombres' 
        , 'apellidos'
        , 'direccion' 
        , 'tlf_celular' 
        , 'tlf_convencional' 
        , 'correo_cli' 
    ];
    protected $table = 'cliente';

    public $timestamps = false;
    
    protected static function newFactory()
    {
        return \Modules\Pedidos\Database\factories\ClienteFactory::new();
    }
}
