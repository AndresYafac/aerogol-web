<?php namespace App\Services;

use App\Interfaces\ScheduleServiceInterface;
use App\WorkDay;
use Carbon\Carbon;
use App\Appointment;

class ScheduleService implements ScheduleServiceInterface
{
    public function isAvailableInterval($date, $courtId, Carbon $start){
        $exists =Appointment::where('court_id',$courtId)
                    ->where('schedule_date',$date)
                    ->where('schedule_time',$start->format('H:i:s'))
                    ->exists();

            return !$exists;        
    }


    public function getAvailableIntervals($date,$courtId)
    {
        $workDay = WorkDay::where('active', true)
            ->where('day',$this->getDayFromDate($date))
            ->where('user_id', $courtId)
            ->first([
                    'morning_start','morning_end',
                    'afternoon_start','afternoon_end'
            ]);

            if(!$workDay){
                return [];
            }

            $morningIntervals = $this->getIntervals(
                $workDay->morning_start, $workDay->morning_end,
                $date, $courtId
            );

            $afternoonIntervals = $this->getIntervals(
                $workDay->afternoon_start, $workDay->afternoon_end,
                $date, $courtId
            );

            $data = [];
            $data['morning'] = $morningIntervals;
            $data['afternoon'] = $afternoonIntervals; 

            return $data;
    }

	private function getDayFromDate($date)
	{
        $dateCarbon = new Carbon($date);
        //dayoWeek
        //cabon
        //workday
        $i = $dateCarbon->dayOfWeek;
        $day = ($i==0 ? 6 : $i-1);
        return $day;
	}

	
	private function getIntervals($start, $end, $date, $courtId){
            $start = new Carbon($start);
            $end = new Carbon($end);

            $intervals = [];

            while($start < $end) {
                $interval = [];

                $interval['start'] = $start->format('g:i A');

                $available = $this->isAvailableInterval($date,$courtId,$start);

                $start->addMinutes(60);
                $interval['end'] = $start->format('g:i A');

                if ($available){
                    $intervals []= $interval;
                }
            }

            return $intervals;
    }
}