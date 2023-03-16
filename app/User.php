<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/

    public function deportes()
    {
        return $this->belongsToMany(Deporte::class)->withTimestamps();
    }

    public function scopeClientes($query)
    {
        return $query->where('role','clientes');
    }

    public function scopeEmpleado($query)
    {
        return $query->where('role','empleado');
    }

    public function asCourtAppointments()
    {
        return $this->hasMany(Appointment::class, 'court_id');
    }

    public function attendedAppointments()
    {
        return $this->asCourtAppointments()->where('status','Atendida');
    }

    public function cancelledAppointments()
    {
        return $this->asCourtAppointments()->where('status','Cancelada');
    }

    public function asClienteAppointments()
    {
        return $this->hasMany(Appointment::class, 'cliente_id');
    }
}
