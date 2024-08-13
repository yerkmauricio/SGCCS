<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class actua extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'actuas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'documento',
        'tipo',
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


    public function casos()
    {
        return $this->belongsTo(caso::class);
    }
}
