<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mensaje extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'mensajes';

    protected $fillable = [
        'tipo_mensaje_id',
        'tipo_persona_id',
        'user_id',
        'fecha'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fecha = now(); // Establece la fecha y hora actual
        });
    }

    public function tipo_mensaje()
    {
        return $this->belongsTo(tipo_mensaje::class, 'tipo_mensaje_id');
    }

    public function tipo_persona()
    {
        return $this->belongsTo(tipo_persona::class, 'tipo_persona_id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }






}
