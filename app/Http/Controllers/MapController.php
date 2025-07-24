<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

class MapController extends Controller
{
    //
    public function ajaxSearch(Request $request)
{
    $query = $request->query('query');

    if (!$query) {
        return response()->json(['results' => []]);
    }

    // Step 1: Ambil fsq_id dari hasil pencarian
    $searchResponse = Http::withHeaders([
        'Authorization' => env('FOURSQUARE_API_KEY'),
    ])->get('https://api.foursquare.com/v3/places/search', [
        'query' => $query,
        'll' => '-6.2,106.8',
        'limit' => 10,
    ]);

    if ($searchResponse->failed()) {
        return response()->json([
            'results' => [],
            'error' => 'Failed to fetch place IDs from Foursquare.',
        ], 500);
    }

    $places = collect($searchResponse->json('results') ?? []);
    $fsqIds = $places->pluck('fsq_id')->all();

    // Step 2: Ambil detail, photo, dan review untuk setiap fsq_id
    $results = [];

    foreach ($places as $place) {
        $fsqId = $place['fsq_id'];

        // Ambil detail
        $detailResponse = Http::withHeaders([
            'Authorization' => env('FOURSQUARE_API_KEY'),
        ])->get("https://api.foursquare.com/v3/places/{$fsqId}");

        if ($detailResponse->failed()) {
            continue;
        }

        $detail = $detailResponse->json();

        // Ambil photo
        $photoResponse = Http::withHeaders([
            'Authorization' => env('FOURSQUARE_API_KEY'),
        ])->get("https://api.foursquare.com/v3/places/{$fsqId}/photos");

        $photos = collect($photoResponse->json())->map(function ($photo) {
            return [
                'url' => $photo['prefix'] . 'original' . $photo['suffix'], // ukuran bisa diganti
                'width' => $photo['width'],
                'height' => $photo['height'],
            ];
        });

        // Ambil review (tips)
        $tipsResponse = Http::withHeaders([
            'Authorization' => env('FOURSQUARE_API_KEY'),
        ])->get("https://api.foursquare.com/v3/places/{$fsqId}/tips");

        $tips = collect($tipsResponse->json())->pluck('text');

        // Gabung semua data
        $results[] = [
            'id' => $fsqId,
            'name' => $place['name'],
            'location' => $place['location'] ?? [],
            'categories' => $place['categories'] ?? [],
            'details' => $detail,
            'photos' => $photos,
            'reviews' => $tips,
        ];
    }

    return response()->json([
        'results' => $results,
    ]);
}


public function searchNearby(Request $request)
{
    $lat = $request->query('lat');
    $lng = $request->query('lng');
    $radius = $request->query('radius', 300); // default 300 meter

    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', 'https://api.foursquare.com/v3/places/search', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => env('FOURSQUARE_API_KEY'),
        ],
        'query' => [
            'll' => "$lat,$lng",
            'radius' => $radius,
            'limit' => 20,
        ],
    ]);

    $data = json_decode($response->getBody(), true);

    return response()->json($data);
}
}
