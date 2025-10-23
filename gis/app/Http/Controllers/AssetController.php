<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Http\JsonResponse;

class AssetController extends Controller
{
    public function geojson(): JsonResponse
    {
        $assets = Asset::all();

        $features = $assets->map(function($a){
            return [
                'type' => 'Feature',
                'id' => $a->id,
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float)$a->longitude, (float)$a->latitude],
                ],
                'properties' => [
                    'name' => $a->name,
                    'category' => $a->category,
                    'created_at' => $a->created_at,
                ],
            ];
        });

        $collection = [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];

        return response()->json($collection);
    }

    public function stats(): JsonResponse
    {
        $total = Asset::count();
        $byCategory = Asset::selectRaw('category, count(*) as cnt')->groupBy('category')->get();
        return response()->json(['total'=>$total,'byCategory'=>$byCategory]);
    }
}
