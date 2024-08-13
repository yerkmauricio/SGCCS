<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sumario extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sumarios';

    protected $fillable = [
        'nombre',
        'apellidop',
        'apellidom',
        'ci',
        'extension',
        'expedito',
        'genero',
        'nacionalidad',
        'fnacimiento',
        'whatsapp',
        # 'tipo_persona_id',
        'institucion',
        'unidad',
        'cargo',
        'domicilioreal',
        'domiciliolegal',
        'domicilioconvencional',
        'gmail',
        'fecha',
        'foto'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
        });
    }
    #public function usuarios()
    #{
    #   return $this->hasMany(usuario::class, 'id', 'id');
    #}

    public function casos()
    {
        return $this->belongsTo(caso::class);
    }
}
