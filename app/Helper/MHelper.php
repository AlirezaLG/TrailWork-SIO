<?php 
namespace App\Helper;

class MHelper{
    
    static function formatWorkTime($date ,$stime , $etime){
        // convert to timestamp to find the difference
        $st = strtotime($date . $stime );
        $et = strtotime($date . $etime );
        
        //diffrent in timestamp and in minute
        $wt = abs( $st - $et ) /60 ;
        
        // reshape the time
        $hour = floor($wt/60);
        $minute =  $wt%60;

        return $hour.' hr, '.$minute. ' min';
    }
    
    static function weeklyWork($row, $working_days){
        $wtime = array();
        // find work time in last 5 days in Timestamp format
        for($i = 0; $i < $working_days ;$i++ ){
            $wtime[] =  isset($row[$i]) ? abs(strtotime($row[$i]->start_time) - strtotime($row[$i]->end_time))/60  : 0 ;
        }
        
        // calculate total time
        $weekly_time = array_sum($wtime);
        $hour = floor($weekly_time/60);
        $minute =  $weekly_time%60;
        return $hour.' hr, '.$minute. ' min';
        
    }
};



