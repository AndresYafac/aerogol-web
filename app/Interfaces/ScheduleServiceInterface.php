<?php namespace App\Interfaces;

use Carbon\Carbon;

interface ScheduleServiceInterface
{
	public function isAvailableInterval($date,$courtId,Carbon $start);
	public function getAvailableIntervals($date,$courtId);
}