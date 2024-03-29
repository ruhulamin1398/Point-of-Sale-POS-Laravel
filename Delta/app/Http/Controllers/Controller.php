<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\employeeDuty;
use App\Models\onlineSync;
use App\Models\posSetting;
use App\Models\unit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if (!session()->has('language')) {
            $pos_setting = posSetting::find(1);
            session(['shop_name' => $pos_setting->shop_name]);
            session(['shop_moto' => $pos_setting->shop_moto]);
            session(['shop_phone' => $pos_setting->shop_phone]);
            session(['shop_email' => $pos_setting->shop_email]);
            session(['language' => $pos_setting->language]);
            session(['logo' => $pos_setting->logo]);
        }
        App::setLocale(session('language'));
    }

    public function calPricePerUnit($sell, $unit_id)
    {

        $unit = unit::find($unit_id);
        $price_per_unit =  $sell / $unit->value;
        return $price_per_unit;
    }


    public function onlineSync($model, $action_type, $reference_id)
    {
        $onlineSync = new onlineSync;
        $onlineSync->model = "App\Models\\" . $model;
        $onlineSync->action_type = $action_type;
        $onlineSync->reference_id = $reference_id;
        $onlineSync->save();
    }
    public function onlinePermissionSync($model, $action_type, $reference_id, $target_id)
    {
        $onlineSync = new onlineSync;
        $onlineSync->model =  $model;
        $onlineSync->action_type = $action_type;
        $onlineSync->reference_id = $reference_id;
        $onlineSync->target_id = $target_id;
        $onlineSync->save();
    }

    public function localization($local)
    {
        return $local;
        App::setLocale('en');
    }


      public function updateEmployeesAttendens($date,$status_id)
    {

        // return $status_id;
        $employees = employee::all();
        
        foreach ($employees as $employee) {
            /// check exist or not 

            $employeeDuty=   employeeDuty::where('date', $date->format("Y-m-d"))->where('employee_id', $employee->id)   ->first();
            if (is_null($employeeDuty)) {
            $employeeDuty= new employeeDuty;
            $employeeDuty->employee_id= $employee->id;
            $employeeDuty->duty_status_id= $status_id;
            $employeeDuty->fixed_duty_hour= $employee->fixed_duty_hour;
            $employeeDuty->worked_hour= 0;
            $employeeDuty->daily_salary= $employee->daily_salary;
            $employeeDuty->daily_salary_extra= 0;
            $employeeDuty->date= $date->format('Y-m-d');
            $employeeDuty->save();
            }

            else{  
                $employeeDuty->duty_status_id= $status_id;
                $employeeDuty->worked_hour= 0;
                $employeeDuty->daily_salary= $employee->daily_salary;
                $employeeDuty->daily_salary_extra= 0;
                $employeeDuty->save();

            }
        }
        // return  employeeDuty::where('date', $date->format("Y-m-d"))->get();
    }
}
