<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class DistanceHelper
{
    public static function getDistance($originLat, $originLng, $destLat, $destLng)
    {
        $apiKey = config('services.google_maps.api_key');

        $origin = "$originLat,$originLng";
        $destination = "$destLat,$destLng";

        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'origins' => $origin,
            'destinations' => $destination,
            'mode' => 'driving',
            'key' => $apiKey,
        ]);

        $data = $response->json();
  
        if ($response->successful() 
            && $data['rows'][0]['elements'][0]['status'] === "OK") {

            $meters = $data['rows'][0]['elements'][0]['distance']['value'];
            $miles  = $meters / 1609.344;

            return [
                'distance'        => round($miles, 2) . ' miles',
                'value_in_miles'  => round($miles, 2),
                'value_in_meters' => $meters,
            ];
        }

        return [
            'error' => $data['rows'][0]['elements'][0]['status'] ?? 'Unable to calculate distance',
        ];
    }

}
