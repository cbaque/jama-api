<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMotorizado extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci_empleado' 
        , 'apodo' 
        , 'mac_tlf' 
    ];
    protected $table = 'motorizado';
    
    protected static function newFactory()
    {
        return \Modules\Auth\Database\factories\UserMotorizadoFactory::new();
    }

    public function empleado()
    {
        return $this->hasOne( 'Modules\Auth\Entities\Empleado' , 'ci_empleado' , 'ci_empleado' );
    }      
}
