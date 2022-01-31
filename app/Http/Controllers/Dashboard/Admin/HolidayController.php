<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weekend;
use App\Models\Holiday;
use App\Models\Project;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\Alert;
use Illuminate\Support\Facades\Http;

class HolidayController extends Controller
{
    public function index()
    {
        $title_section = [
            'title' => 'Feriados y Fines de Semana.',
            'description' => '', 
        ];

        $holidays = Holiday::all();
        $weekendDays = Weekend::all();
        return view('dashboard.admin.holydays.index')
            ->with('title_section', $title_section)
            ->with('holidays', $holidays)
            ->with('weekendDays', $weekendDays);
    }

    public function setHolidays()
    {
        $this->setChilePublicHolidays();
        $this->setWeekendDays();
        return redirect()->route('admin.holidays.index');

    }

    public function setChilePublicHolidays()
    {
        Holiday::truncate();
        $year = Carbon::now()->year;
        
        $response = Http::get('https://apis.digital.gob.cl/fl/feriados/'.$year);
        if($response->json() && isset($response->json()['error'])){
            return false;
        }else{
            foreach ($response->json() as $holidayChile) {
                $holiday = new Holiday;
                $holiday->name = $holidayChile['nombre'];
                $holiday->date = $holidayChile['fecha'];
                $holiday->type = $holidayChile['tipo'];
                $holiday->save();
            }
        }
    }

    public function setWeekendDays()
    {
        Weekend::truncate();

        $year = Carbon::now()->year;
        $startDate = Carbon::createFromFormat('Y-m-d',$year.'-01-01'); 
        $endDate = Carbon::createFromFormat('Y-m-d',$year.'-12-31');
        
        for($i = $startDate; $i <= $endDate; $i->addDays(1)){

            $dia = $i->toDateString();
            if(Project::isWeekEndDay($dia)){
                $weekendDay = new Weekend;
                $weekendDay->name = $i->isoFormat('dddd');
                $weekendDay->date = $dia;
                $weekendDay->type = 'Fin de Semana';
                $weekendDay->save();
            } 
        }
    }


}
