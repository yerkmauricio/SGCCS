<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipo_mensaje extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'tipo_mensajes';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
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


    public function mensajes()
    {
        return $this->belongsTo(mensaje::class);
    }

}
