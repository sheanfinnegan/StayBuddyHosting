<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Faker\Factory as Faker;
use App\Models\WaitingList;

class SearchController extends Controller


{
    
    //
    public function index() {
        return view('searchPage');
    }

    public function checkWaitingList($fsq_id)
        {
            $exists = WaitingList::where('homestay_id', $fsq_id)->get();
            $home = \App\Models\HomeDetail::where('fsq_id', $fsq_id)->first();

            $data = $exists->map(function ($wl) {
                $userCount = \App\Models\User::where('wlid', $wl->wlid)->count();
                return [
                    'wlid' => $wl->wlid,
                    'created' => $wl->created,
                    'done' => $wl->done,
                    'user_count' => $userCount
                ];
            });
            // dd($exists);
            return response()->json(['dataWL' => $data, 'home' => $home]);
        }

    public function storeHomeDetails(Request $request)
    {
        $homes = $request->input('homes');
        // dd($homes);
        $faker = Faker::create('id_ID');

        
        
    
        foreach ($homes as $result) {
            $fsqId = $result['details']['fsq_id'];
            // dd();
            $time = rand(0, 1) ? 'Bulanan' : 'Tahunan';
            $price = $time === 'Bulanan' ? rand(10, 20) : rand(50, 100);
            $bedroom = rand(1, 5);
            $seriesNumber = rand(1, 20);
             

            $prefix = rand(0, 1) ? 'Pak' : 'Bu';
            $ownerName = $faker->firstName(); // Nama Indonesia dari Faker
            $homestayName = "Homestay $ownerName";

    // Main image diambil dari seri yang sama
            $mainImage = "assets/homestay/hs-{$seriesNumber}.jpg";

            // Photos (main image + 4 foto random lainnya)
            $photos = [];
            $reviews = [];
            $reviewCount = rand(2, 10);
            for ($i = 0; $i < $reviewCount; $i++) {
                $reviews[] = [
                    'name' => 'Anonymous',
                    'rating' => rand(35, 50) / 10,
                    'comment' => $faker->paragraph(1)
                ];
            }
            for ($i = 0; $i < 5; $i++) {
                $photoNumber = rand(1, 20);
                $photos[] = "assets/fasilitas/fas-{$photoNumber}.jpg";
            }
            $averageRating = count($reviews) > 0
    ? round(array_sum(array_column($reviews, 'rating')) / count($reviews), 1)
    : 0;
            
            

            
            $homeDetail = \App\Models\HomeDetail::firstOrCreate(
                ['fsq_id' => $fsqId],
                [
                    'name' => $homestayName,
                    'rating' => $averageRating,
                    'price' => $price,
                    'duration' => $time,
                    'contact' => '+62 ' . rand(8000000000, 8999999999),
                    'area' => rand(30, 100),
                    'bedroom' => $bedroom,
                    'air_conditioning' => rand(0, $bedroom),
                    'bathroom' => rand(1, 5),
                    'kitchen' => rand(0, $bedroom),
                    'max_pax' => $bedroom,
                    'hot_water' => rand(0, $bedroom),
                    'refrigerator' => rand(0, $bedroom),
                    'wifi' => rand(0, $bedroom),
                    'tv' => rand(0, $bedroom),
                    'main_images' => $mainImage,
                    'photos' => json_encode($photos),
                    'reviews' => json_encode($reviews), // Simpan reviews sebagai JSON
                    'alamat' => $result['details']['location']['formatted_address']
                ]
            );

            $data = WaitingList::where('homestay_id', $fsqId)->get();

            $finalResult[] = [
                'details' => $homeDetail->toArray(),
                'data'  => $data->toArray()
            ];
        }

        // dd($finalResult);
    
        return response()->json(['message' => 'Data berhasil disimpan', 'details' => $finalResult]);
    }

    public function storeHomeDetailsClick(Request $request)
    {
        $homes = $request->input('homes');
        $faker = Faker::create('id_ID');
        // dd($homes);
        
    
        foreach ($homes as $result) {
            // dd($result);
            $fsqId = $result['fsq_id'];

            $time = rand(0, 1) ? 'Bulanan' : 'Tahunan';
            $price = $time === 'Bulanan' ? rand(10, 20) : rand(50, 100);
            $bedroom = rand(1, 5);
            $seriesNumber = rand(1, 20);
            $prefix = rand(0, 1) ? 'Pak' : 'Bu';
            $ownerName = $faker->firstName(); // Nama Indonesia dari Faker
            $homestayName = "Homestay $ownerName";

    // Main image diambil dari seri yang sama
            $mainImage = "assets/homestay/hs-{$seriesNumber}.jpg";

            // Photos (main image + 4 foto random lainnya)
            $photos = [];
            $reviews = [];
            $reviewCount = rand(2, 10);
            for ($i = 0; $i < $reviewCount; $i++) {
                $reviews[] = [
                    'name' => 'Anonymous',
                    'rating' => rand(35, 50) / 10,
                    'comment' => $faker->paragraph(1)
                ];
            }

            for ($i = 0; $i < 5; $i++) {
                $photoNumber = rand(1, 20);
                $photos[] = "assets/fasilitas/fas-{$photoNumber}.jpg";
            }

            $averageRating = count($reviews) > 0
    ? round(array_sum(array_column($reviews, 'rating')) / count($reviews), 1)
    : 0;
            

            
            $homeDetail = \App\Models\HomeDetail::firstOrCreate(
                ['fsq_id' => $fsqId],
                [
                    'name' => $homestayName,
                    'rating' => $averageRating,
                    'price' => $price,
                    'duration' => $time,
                    'contact' => '+62 ' . rand(8000000000, 8999999999),
                    'area' => rand(30, 100),
                    'bedroom' => $bedroom,
                    'air_conditioning' => rand(0, $bedroom),
                    'bathroom' => rand(1, 5),
                    'kitchen' => rand(0, $bedroom),
                    'max_pax' => $bedroom,
                    'hot_water' => rand(0, $bedroom),
                    'refrigerator' => rand(0, $bedroom),
                    'wifi' => rand(0, $bedroom),
                    'tv' => rand(0, $bedroom),
                    'main_images' => $mainImage,
                    'photos' => json_encode($photos),
                    'reviews' => json_encode($reviews), // Simpan reviews sebagai JSON
                    'alamat' => $result['location']['formatted_address']

                ]
            );

            $data = WaitingList::where('homestay_id', $fsqId)->get();
        
            
            $finalResult[] = [
                'details' => $homeDetail->toArray(),
                'data' => $data->toArray()
            ];
        }

        // dd($finalResult);
    
        return response()->json(['message' => 'Data berhasil disimpan', 'details' => $finalResult]);
    }
    

}
