<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'estado',
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
        return $this->belongsTo(usuario::class);
    }
}
