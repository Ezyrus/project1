<?php
date_default_timezone_set('Asia/Manila'); // PHT Timezone

class Main
{

    public static function getCurrentDateTime()
    {
        return (new DateTime())->format('Y-m-d H:i:s');
    }

    public static function getCurrentDate()
    {
        return (new DateTime())->format('Y-m-d');
    }

    public static function formatDateTime($dateTimeString)
    {
        if ($dateTimeString === '0000-00-00 00:00:00') {
            return "...";
        }
        $dateTime = new DateTime($dateTimeString);
        return $dateTime->format('F j, Y \a\t h:i:s A');
    }

}

?>