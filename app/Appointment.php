<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [
        'description',
        'deporte_id',
        'court_id',
        'cliente_id',
        'schedule_date',
        'schedule_time',
        'type'
    ];

    //$appointmet->deporte
    public function deporte()
    {
        return $this->belongsTo(Deporte::class);
    }

    //$appointmet->cancha
    public function court()
    {
        return $this->belongsTo(User::class);
    }

    //$appointmet->cliente
    public function cliente()
    {
        return $this->belongsTo(User::class);
    }

    public function cancellation()
    {
        return $this->hasOne(CancelledAppointment::class);
    }

    //accessor
    //$appointmet->schedule_time_12
    public function getScheduleTime12Attribute(){
        return (new Carbon($this->schedule_time))
            ->format('g:i A');
    } 
}
