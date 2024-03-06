<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function index()
    {
        // Initialize Guzzle client
        $client = new Client();

        // API endpoint URL
        $url = 'https://api.open-meteo.com/v1/forecast'; // Updated based on documentation

        // Parameters for the next 7 days
        $parameters = [
        'latitude' => 41.388333, // Barcelona's latitude
        'longitude' => 2.168333, // Barcelona's longitude
        'hourly' => 'rain',
        ];

        try {
        // Send GET requests to the API for each time frame
        $Response = $client->request('GET', $url, ['query' => $parameters]);

        // Get response bodies
        $data = json_decode($Response->getBody()->getContents(), true);

        // Analyze precipitation data for each time frame
        $willRain = $this->analyzePrecipitation($data);

        // Pass data to view
        return view('weather', compact('willRain', 'data'));
        } catch (\Exception $e) {
        // Handle error
        return view('error', ['error' => $e->getMessage()]);
        }
    }

    private function analyzePrecipitation($data)
    {
        // Check if "hourly" key exists
        if (isset($data['hourly'])) {
            // Access data using the correct key (replace 'data' if required)
            $hourlyData = $data['hourly'];
        
            // Look for any hour with rain using PHP's array_filter function
            $hasRain = array_filter($hourlyData, function ($hour) {
            return isset($hour['rain']) && $hour['rain'] > 0;
            });
        
            // Check if any element is found in the filtered array
            return !empty($hasRain);
        } else {
            // Handle the case where data is unavailable
            // (e.g., log an error message or return a default value)
        }
        return false;
    }
}

