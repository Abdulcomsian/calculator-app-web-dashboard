<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $apiKey = env('OPENWEATHER_API_KEY');

        if ($city) {
            $currentResponse = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'imperial',
            ]);

            $forecastResponse = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'imperial',
            ]);
        } elseif ($latitude && $longitude) {
            $currentResponse = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => $apiKey,
                'units' => 'imperial',
            ]);

            $forecastResponse = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => $apiKey,
                'units' => 'imperial',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'City or coordinates must be provided',
            ], 400);
        }

        if ($currentResponse->successful() && $forecastResponse->successful()) {
            $currentData = $currentResponse->json();
            $forecastData = $forecastResponse->json();

            $response = [
                'status' => 'success',
                'city' => $currentData['name'],
                'country' => $currentData['sys']['country'],
                'latitude' => $currentData['coord']['lat'],
                'longitude' => $currentData['coord']['lon'],
                'icon' => 'http://openweathermap.org/img/w/' . $currentData['weather'][0]['icon'] . '.png',
                'current_temperature' => $currentData['main']['temp'],
                'current_temperature_c' => round(($currentData['main']['temp'] - 32) * 5 / 9, 2),
                'current_conditions' => ucwords($currentData['weather'][0]['description']),
                'temp_min' => $currentData['main']['temp_min'],
                'temp_max' => $currentData['main']['temp_max'],
                'pressure' => $currentData['main']['pressure'], // Pressure in hPa
            ];

            $forecastList = [];
            $previous_date = '';

            foreach ($forecastData['list'] as $key) {
                $dt_txt = $key['dt_txt'];
                $date = new \DateTime($dt_txt);
                $current_date = $date->format('Y-m-d');

                if ($current_date != $previous_date) {
                    $forecastList[] = [
                        'datetime' => $dt_txt,
                        'temperature' => $key['main']['temp'],
                        'temperature_c' => round(($key['main']['temp'] - 32) * 5 / 9, 2),
                        'weather_description' => $key['weather'][0]['description'],
                        'humidity' => $key['main']['humidity'],
                        'wind_speed' => round($key['wind']['speed'] * 3.6, 2),
                        'pressure' => $key['main']['pressure'], // Pressure in hPa
                    ];
                    $previous_date = $current_date;
                }
            }

            $response['forecast'] = array_slice($forecastList, 0, 5);

            return response()->json($response);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve weather data',
            ], $currentResponse->status() ?: $forecastResponse->status());
        }
    }
}
