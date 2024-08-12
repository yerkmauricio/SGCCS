<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personas';

    protected $fillable = [
        'nombre',
        'apellidop',
        'apellidom',
        'ci',
        'expedito',
        'genero',
        'nacionalidad',
        'fnacimiento',
        'whatsapp',
        'tipo_persona_id',
        'institucion',
        'unidad',
        'cargo',
        'carrera',
        'sede',
        'fecha'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
        });
    }

    public function usuarios()
    {
        return $this->hasMany(usuario::class, 'idp', 'id');
    }

    public function registros()
    {
        return $this->hasMany(registro::class, 'idp', 'id');

    }
    // public function tipo_persona()
    // {
    //     return $this->belongsTo(tipo_persona::class, 'tipo_persona_id');
    // }
    // public function tipo_personas()
    // {
    //     return $this->belongsToMany(Tipo_Persona::class, 'persona_tipo_persona', 'persona_id', 'tipo_persona_id');
    // }
    public function tipoPersonas()
    {
        return $this->belongsToMany(Tipo_Persona::class, 'persona_tipo_persona');
    }

}
