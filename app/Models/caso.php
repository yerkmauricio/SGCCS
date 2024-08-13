<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class caso extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'casos';

    protected $fillable = [
        'nombre',
        'mae',
        'nfolio',
        'identificacion_caso',
        'estado',
        'tipo_caso_id',
        'actua_id',
        'hoja_ruta',
        'remitente',
        'radicatoria',
        'adm',
        'sumario_id',
        'antecedentes',
        'ejecutoria',
        'fecha',
        
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
           
        });
    }
    
    public function sumario()
    {
        return $this->belongsTo(sumario::class, 'sumario_id');
    }
  
    public function actua()
    {
        
            return $this->belongsTo(actua::class, 'actuas_id');
    }

    public function tipo_caso()
    {
        
            return $this->belongsTo(tipo_caso::class, 'tipo_caso_id');
    }
}
