<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class DistanceHelper
{
    public static function getDistance($origin, $destination)
    {
        $apiKey = config('services.google_maps.api_key'); // Retrieve API key from configuration

        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'origins' => $origin,
            'destinations' => $destination,
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if ($data['status'] === 'OK' && isset($data['rows'][0]['elements'][0]['distance'])) {
                $meters = $data['rows'][0]['elements'][0]['distance']['value'];
                $miles = $meters / 1609.344; // Convert meters to miles

                return [
                    'distance' => round($miles, 2) . ' miles', // e.g., "9.03 miles"
                    'value_in_miles' => round($miles, 2),
                    'value_in_meters' => $meters,
                ];
            }

            return [
                'error' => 'Unable to calculate distance. Check addresses or API quota.',
            ];
        }

        return [
            'error' => 'Failed to connect to Google API. Status: ' . $response->status(),
        ];
    }   
}
