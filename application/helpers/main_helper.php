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

    // Removing the data type of the base64
    public static function formatDecodedBase64($base64) {
        $locateComma = strpos($base64, ',');
        $rawBase64 = substr($base64, $locateComma + 1);
        return base64_decode($rawBase64);
    }

    // Adding the data type of the base64
    public static function formatEncodedBase64($blob) {
        return 'data:image/jpeg;base64,' . base64_encode($blob);
    }

}

?>