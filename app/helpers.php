<?php
use Carbon\Carbon;

if(!function_exists('prettyDateTimeString')){
    function prettyDateTimeString(Carbon|string $dateTime): string
    {
        if(is_string($dateTime)){
            $dateTime = Carbon::parse($dateTime);
        }

        return $dateTime->format('l, d/m/Y, H:i');
    }

}
