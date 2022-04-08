<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci_empleado' 
        , 'nombres' 
        , 'apellidos' 
        , 'direccion' 
        , 'tlf' 
        , 'cargo' 
    ];
    protected $table = 'empleado';
    protected $appends = [ 'name' ];   
    
    protected static function newFactory()
    {
        return \Modules\Auth\Database\factories\EmpleadoFactory::new();
    }

    public function getNameAttribute()
    {
        return $this->nombres.' '.$this->apellidos;
    }       
}
