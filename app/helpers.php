<?php
use Carbon\Carbon;

if(!function_exists('prettyDateTimeString')){
    /**
     * Returns format example: Saturday, 02/05/2026, 12:00
     *
     * @param Carbon|string $dateTime
     * @return string
     */
    function prettyDateTimeString(Carbon|string $dateTime): string
    {
        if(is_string($dateTime)){
            $dateTime = Carbon::parse($dateTime);
        }

        return $dateTime->format('l, d/m/Y, H:i');
    }

}

if(!function_exists('prettyTimeFromDateString')){
    /**
     * Returns format example: 14:00
     * @param Carbon|string $dateTime
     * @return string
     */
    function prettyTimeFromDateString(Carbon|string $dateTime):string
    {
        if(is_string($dateTime)){
            $dateTime = Carbon::parse($dateTime);
        }

        return $dateTime->format('H:i');
    }
}
