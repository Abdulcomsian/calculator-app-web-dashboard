<?php

return [
    'api_key'             => env('OPENWEATHER_API_KEY', ''),
    'onecall_api_version' => '2.5',
    'historical_api_version' => '2.5',
    'forecast_api_version' => '2.5',
    'polution_api_version' => '2.5',
    'geo_api_version' => '1.0',
    'lang'         => env('OPENWEATHER_API_LANG', 'en'),
    'date_format'       => 'm/d/Y',
    'time_format'       => 'h:i A',
    'day_format'        => 'l',
    'temp_format'       => 'c'
];
