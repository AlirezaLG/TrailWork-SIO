<?php

namespace App\Helper;

class MHelper
{

    public static function reShapeWorkTime($date, $startTime, $endTime)
    {
        $startTimestamp = strtotime($date . $startTime);
        $endTimestamp = strtotime($date . $endTime);

        $timeDiffMinutes = abs($startTimestamp - $endTimestamp);

        return self::formatTime($timeDiffMinutes);
    }

    public static function totalWork($rows, $workingDays)
    {
        $totalTime = 0;

        for ($i = 0; $i < $workingDays; $i++) {
            $rowTime = isset($rows[$i]) ? strtotime($rows[$i]->end_time) - strtotime($rows[$i]->start_time) : 0;
            $totalTime += $rowTime;
        }

        return self::formatTime($totalTime);
    }

    public static function totalTimesPerProject($projectsTimes)
    {
        $projectWorkTimes = [];

        foreach ($projectsTimes as $index => $projectTimes) {
            $totalProjectTime = 0;

            foreach ($projectTimes->tmas as $timeLog) {
                $logTime = strtotime($timeLog->date . $timeLog->end_time) - strtotime($timeLog->date . $timeLog->start_time);
                $totalProjectTime += $logTime;
            }

            $projectWorkTimes[$index] = self::formatTime($totalProjectTime);
        }

        return $projectWorkTimes;
    }

    private static function formatTime($timeInSeconds)
    {
        $totalHours = floor($timeInSeconds / 3600);
        $totalMinutes = ($timeInSeconds % 3600) / 60;

        return "$totalHours hr, $totalMinutes min";
    }
};
