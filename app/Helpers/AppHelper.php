<?php
namespace App\Helpers;

use App\Http\Livewire\Holiday;
use App\Models\Holidays;

class AppHelper
{
    public static function instance()
    {
        return new AppHelper();
    }

    //$year = 2013, $month = 6, $ignore = [6,1]
    function countDays($year, $month, $ignore = []) {
        array_push($ignore,6,1); // 6 and 1 are saturday and sunday
        $holidayList = Holidays::where(['year'=>$year,'month'=>$month])->pluck('date')->toArray();
        
        $count = 0;
        $counter = mktime(0, 0, 0, $month, 1, $year);
        while (date("n", $counter) == $month) {
            
            if (in_array(date("w", $counter), $ignore) == false && !in_array(date("Y-m-d",$counter),$holidayList)) {
                $count++;
            }
            $counter = strtotime("+1 day", $counter);
        }
        return $count;
    }
}