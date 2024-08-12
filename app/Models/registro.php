<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registro extends Model
{

    use HasFactory;

    protected $table = 'registros';

    protected $fillable = [
        'persona_id',
        'usuario_id',
        'mensaje_id',
        'fecha'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
        });
    }


    public function persona()
    {
        return $this->belongsTo(persona::class, 'persona_id');
    }

    public function usuario()
    {
        return $this->belongsTo(usuario::class, 'usuario_id');
    }

    public function mensaje()
    {
        return $this->belongsTo(mensaje::class, 'mensaje_id');
    }
}
