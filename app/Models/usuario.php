<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidop',
        'apellidom',
        'ci',
        'expedito',
        'genero',
        'role_id',
        'cargo',
        'unidad',
        'fecha'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
        });
    }


    public function rol()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function registros()
    {
        return $this->belongsTo(registro::class);
    }
}
