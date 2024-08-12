<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apellidopaterno',
        'apellidomaterno',
        'ci',
        'expedito',
        'genero',
        'fnacimiento',
        'cargo',
        'unidad',
        'foto',
        'estado',
        'fsuspension',
        'universidad',
        'localizacion',
        'carrera',
        'fecha'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //          // Establece la fecha y hora actual
    //         //$model->estado = true;
    //
    //     });
    // }

    public static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            // Verifica si el campo 'estado' está vacío o nulo y establece un valor predeterminado
            if (is_null($model->estado)) {
                $model->estado = true; // O el valor que desees asignar por defecto
            }
            $model->fecha = now();
            $model->finicio = now();
         //$model->password = '0';
        });
    }
    public function mensajes()
    {
        return $this->belongsTo(mensaje::class);
    }
    public function adminlte_image(){
        return $this->foto ? asset('storage/' . $this->foto) : asset('images/default-user.png');
    }
    public function adminlte_desc(){
        $roles = $this->getRoleNames(); // Retorna una colección de roles
        return $roles->isNotEmpty() ? $roles->implode(', ') : 'No Role';

    }
    public function adminlte_profile_url()
    {
        return route('roles.show', $this->id);
    }
}
