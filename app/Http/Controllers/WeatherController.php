<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function index()
    {
        // Initialize Guzzle client
        $client = new Client();

        // API endpoint URL
        $url = 'https://api.open-meteo.com/v1/forecast'; // Updated based on documentation

        // Parameters for soon (next few hours)
        $soonParams = [
        'latitude' => 41.388333, // Barcelona's latitude
        'longitude' => 2.168333, // Barcelona's longitude
        'hourly' => 'precipitation',
        'daily' => '', // Removed daily parameter - not needed for hourly data
        'location_mode' => 'coords', // Updated location mode as per documentation
        'limit' => 6, // Adjust the limit based on your definition of "soon"
        ];

        // Parameters for next 24 hours
        $next24Params = [
        'latitude' => 41.388333,
        'longitude' => 2.168333,
        'hourly' => 'precipitation',
        'daily' => '',
        'location_mode' => 'coords',
        'limit' => 24,
        ];

        // Parameters for next 48 hours
        $next48Params = [
        'latitude' => 41.388333,
        'longitude' => 2.168333,
        'hourly' => 'precipitation',
        'daily' => '',
        'location_mode' => 'coords',
        'limit' => 48,
        ];

        try {
        // Send GET requests to the API for each time frame
        $soonResponse = $client->request('GET', $url, ['query' => $soonParams]);
        $next24Response = $client->request('GET', $url, ['query' => $next24Params]);
        $next48Response = $client->request('GET', $url, ['query' => $next48Params]);

        // Get response bodies
        $soonData = json_decode($soonResponse->getBody()->getContents(), true);
        $next24Data = json_decode($next24Response->getBody()->getContents(), true);
        $next48Data = json_decode($next48Response->getBody()->getContents(), true);

        // Analyze precipitation data for each time frame
        $soonWillRain = $this->analyzePrecipitation($soonData);
        $next24WillRain = $this->analyzePrecipitation($next24Data);
        $next48WillRain = $this->analyzePrecipitation($next48Data);

        // Pass data to view
        return view('weather', compact('soonWillRain', 'next24WillRain', 'next48WillRain'));
        } catch (\Exception $e) {
        // Handle error
        return view('error', ['error' => $e->getMessage()]);
        }
    }

        // Function to analyze precipitation data
        private function analyzePrecipitation($data)
    {
    // Check if "hourly" and "data" keys exist before accessing them
    if (isset($data['hourly']) && isset($data['hourly']['data'])) {
        foreach ($data['hourly']['data'] as $hour) {
        if (isset($hour['precipitation']) && $hour['precipitation'] > 0) {
            return true;
        }
        }
    } else {
        // Handle the case where data is unavailable
        // (e.g., log an error message or return a default value)
    }
    return false;
    }
}
