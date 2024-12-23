<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleDistanceService
{
    public function getDistance($origin, $destination)
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
                return [
                    'distance' => $data['rows'][0]['elements'][0]['distance']['text'], // e.g., "14.5 km"
                    'value' => $data['rows'][0]['elements'][0]['distance']['value'], // e.g., 14500 (meters)
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
