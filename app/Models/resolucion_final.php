<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class resolucion_final extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'resolucion_finals';

    protected $fillable = [
        'apertura',
        'descripcion',
        
        'fecha'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
            // $model->estado = 1;

        });
    }


    public function caso()
    {
        return $this->belongsTo(caso::class, 'caso_id');
    }

}
