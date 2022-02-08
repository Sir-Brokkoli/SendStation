<?php
namespace Sendstation;

class DateHandler{
    public static function HandleDateToString($dateString){
        $date = new \DateTime($dateString);
        $passedDays = self::GetDaysPassed($date);

        $outputString = "";
        if($passedDays == 0) {
            $outputString = "Today, " . $date->format('h:m') . ".";
        }
        else if($passedDays == 1) {
            $outputString = "Yesterday, " . $date->format('h:m') . ".";
        }
        else if($passedDays < 14) {
            $outputString = $passedDays . " days ago.";
        }
        else if($passedDays < 56) {
            $outputString = round($passedDays / 7) . " weeks ago.";
        }
        else if($passedDays < 365) {
            //Add more precise calculation - most months are longer than 28 days
            $outputString = round($passedDays / 28) . "months ago.";
        }
        else {
            $outputString = round($passedDays / 365) . " years ago.";
        }
        return $outputString;
    }

    public static function GetDaysPassed($date){
        $currentDate = new \DateTime(date('Y-m-d'));
        $dateReformat = new \DateTime($date->format('Y-m-d'));

        $days = $dateReformat->diff($currentDate)->format('%a');
        return $days;
    }
}
?>
