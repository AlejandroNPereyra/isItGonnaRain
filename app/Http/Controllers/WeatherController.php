<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function getPrecipitationData(Request $request)
    {
        // Load the array of European cities
        $europeanCities = require(public_path('european_cities.php'));

        // Check if latitude and longitude parameters are present
        if ($request->has(['latitude', 'longitude'])) {
            // Initialize Guzzle client
            $client = new Client();

            // API endpoint URL
            $url = 'https://api.open-meteo.com/v1/forecast'; // Updated based on documentation

            // Parameters for the next 3 days
            $parameters = [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'hourly' => 'rain',
                'forecast_days' => '3'
            ];

            try {
                // Send GET request to the API
                $response = $client->request('GET', $url, ['query' => $parameters]);

                // Get response body
                $data = json_decode($response->getBody()->getContents(), true);

                // Pass data and European cities to view
                return view('weather', compact('data', 'europeanCities'));
            } catch (\Exception $e) {
                // Handle error
                return view('error', ['error' => $e->getMessage()]);
            }
        } else {
            // No city selected, return default view
            return view('weather', compact('europeanCities'));
        }
    }
}
