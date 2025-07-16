<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function fetch(Request $request)
    {
        $year = $request->get('year', date('Y'));

        $holidays = array_merge(
            config('holidays.regular'),
            config('holidays.special')
        );

        $events = [];

        foreach ($holidays as $holiday) {
            $dateStr = $holiday['date'] . ' ' . $year;
            $date = date('Y-m-d', strtotime($dateStr));

            $events[] = [
                'title' => $holiday['event'],
                'start' => $date,
                'allDay' => true,
                'display' => 'background',
                'isHoliday' => true,
                'rrule' => [//make the holidays repeat yearly
                    'freq' => 'yearly', 
                    'byMonth' => date('m', strtotime($date)),
                    'byDay' => date('d', strtotime($date)) 
                ]
            ];
        }

        return response()->json($events);
    }
}
