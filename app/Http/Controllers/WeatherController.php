<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function getPrecipitationData()
    {
        // Initialize Guzzle client
        $isItGonnaRain = new Client();

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
        $response = $isItGonnaRain->request('GET', $url, ['query' => $parameters]);

        // Get response bodies
        $data = json_decode($response->getBody()->getContents(), true);

        // Pass data to view
        return view('weather', compact('data'));
        } catch (\Exception $e) {
        // Handle error
        return view('error', ['error' => $e->getMessage()]);
        }
    }
}
