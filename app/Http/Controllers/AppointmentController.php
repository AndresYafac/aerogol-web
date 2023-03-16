<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deporte;
use App\Appointment;
use App\CancelledAppointment;

use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;
use Validator;

class AppointmentController extends Controller
{
    public function index()
    {   

        $role = auth()->user()->role;

        if ($role == 'admin') { 
        $pendingAppointments = Appointment::where('status', 'Reservada')
            ->paginate(10);
        $confirmedAppointments = Appointment::where('status', 'Confirmada')
            ->paginate(10);
        $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
            ->paginate(10);


        }elseif($role == 'empleado'){
        $pendingAppointments = Appointment::where('status','Reservada')
            ->where('court_id',auth()->id())
            ->paginate(10);
        $confirmedAppointments = Appointment::where('status','Confirmada')
            ->where('court_id',auth()->id())
            ->paginate(10);
        $oldAppointments = Appointment::whereIn('status',['Atendida','Cancelada'])
            ->where('court_id',auth()->id())
            ->paginate(10);

        }elseif ($role = 'cliente'){
        $pendingAppointments = Appointment::where('status','Reservada')
            ->where('cliente_id',auth()->id())
            ->paginate(10);
        $confirmedAppointments = Appointment::where('status','Confirmada')
            ->where('cliente_id',auth()->id())
            ->paginate(10);
        $oldAppointments = Appointment::whereIn('status',['Atendida','Cancelada'])
            ->where('cliente_id',auth()->id())
            ->paginate(10);
        }


     
        

        return view('appointments.index', compact('pendingAppointments',
            'confirmedAppointments','oldAppointments','role'));
    }

    public function show(Appointment $appointment)
    {
        $role = auth()->user()->role;
        return view('appointments.show',compact('appointment', 'role'));
    }

    public function create(ScheduleServiceInterface $scheduleService)
    {   
        $deportes = Deporte::all();

        $deporteId = old('deporte_id');
        if ($deporteId){
            $deporte = Deporte::find($deporteId);
            $courts = $deporte->users;
        } else {
            $courts = collect();
        }

        $date = old('schedule_date');
        $courtId = old('court_id');
        if($date && $courtId){
            $intervals = $scheduleService->getAvailableIntervals($date, $courtId);
        } else {
            $intervals = null;
        }

        
        return view('appointments.create',compact('deportes', 'courts','intervals'));
    }
    
    public function store(Request $request, ScheduleServiceInterface $scheduleService)
    {
        $rules = [
            'description' => 'required',
            'deporte_id' => 'exists:deportes,id',
            'court_id' => 'exists:users,id',
            'schedule_time' => 'required'
        ];
        $messages = [
            'schedule_time.required' => 'Por favor seleccione una hora válida para su
            reserva.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request, $scheduleService) {
            $date = $request->input('schedule_date');
            $courtId = $request->input('court_id');
            $schedule_time = $request->input('schedule_time');
            if($date && $courtId && $schedule_time){
                $start = new Carbon($schedule_time);
            } else { 
                return;
            }

            if (!$scheduleService->isAvailableInterval($date, $courtId, $start)) {
                $validator->errors()
                    ->add('available_time','La hora seleccionada ya se encuentra 
                        reservada por otro cliente.');
            }
        });


        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = $request->only([
            'description',
            'deporte_id',
            'court_id',
            'schedule_date',
            'schedule_time',
            'type'
        ]);
        $data['cliente_id'] = auth()->id();

        $carbonTime = Carbon::createFromFormat('g:i A',$data['schedule_time']);
        $data['schedule_time'] =$carbonTime->format('H:i:s');
        Appointment::create($data);

        $notification = 'La reserva se registro correctamente!';
        return back()->with(compact('notification'));
    }

    public function showCancelForm(Appointment $appointment)
    {
        if($appointment->status == 'Confirmada'){
            $role = auth()->user()->role;
            return view('appointments.cancel',compact('appointment','role'));
        }
        
        return redirect('/appointments');
    }

    public function postCancel(Appointment $appointment, Request $request)
    {
        if($request->has('justification')){
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by = auth()->id();

            $appointment->cancellation()->save($cancellation);
        }

        $appointment->status = 'Cancelada';
        $appointment->save(); //update

        $notification = 'La reserva se ha cancelado correctamente.';
        return redirect('/appointments')->with(compact('notification'));
    }

    public function postConfirm(Appointment $appointment)
    {
        
        $appointment->status = 'Confirmada';
        $appointment->save(); //update

        $notification = 'La reserva se ha confirmado correctamente.';
        return redirect('/appointments')->with(compact('notification'));
    }
}
