<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserClientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci_cliente' 
        , 'nombres' 
        , 'apellidos' 
        , 'id_prov' 
        , 'id_canton' 
        , 'id_parroquia' 
        , 'direccion' 
        , 'tlf_celular' 
        , 'tlf_convencional'
        , 'correo_cli'
    ];
    protected $table = 'cliente';
    protected $appends = [ 'name' ];    
    
    protected static function newFactory()
    {
        return \Modules\Auth\Database\factories\UserClientesFactory::new();
    }

    public function getNameAttribute()
    {
        return $this->nombres.' '.$this->apellidos;
    }    
}
