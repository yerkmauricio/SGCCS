<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipo_persona extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'tipo_personas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'tipo_persona_id',
        'fecha'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
            $model->estado = 1;

        });
    }


    // public function personas()
    // {
    //     return $this->belongsTo(persona::class);
    // }
    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'persona_tipo_persona');
    }

    public function mensajes()
    {
        return $this->belongsTo(mensaje::class);
    }
}
