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
        $url = 'https://api.open-meteo.com/weather/forecast';

        // Parameters for soon (next few hours)
        $soonParams = [
            'location' => 'Barcelona',
            'hourly' => 'precipitation',
            'limit' => 6 // Adjust the limit based on the time frame you consider as "soon"
        ];

        // Parameters for next 24 hours
        $next24Params = [
            'location' => 'Barcelona',
            'hourly' => 'precipitation',
            'limit' => 24 // Forecast for next 24 hours
        ];

        // Parameters for next 48 hours
        $next48Params = [
            'location' => 'Barcelona',
            'hourly' => 'precipitation',
            'limit' => 48 // Forecast for next 48 hours
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
        foreach ($data['hourly'] as $hour) {
            if (isset($hour['precipitation']['value']) && $hour['precipitation']['value'] > 0) {
                return true;
            }
        }
        return false;
    }
}
