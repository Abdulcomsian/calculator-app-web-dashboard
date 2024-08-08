<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MapController extends Controller
{
    public function getRoute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|string',
            'to' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $from = urlencode($request->input('from'));
        $to = urlencode($request->input('to'));

        try {
            $client = new Client();
            $response = $client->get("https://maps.googleapis.com/maps/api/directions/json?origin={$from}&destination={$to}&key=" . env('GOOGLE_MAPS_API_KEY'));

            $data = json_decode($response->getBody(), true);

            if ($data['status'] === 'OK') {
                return response()->json([
                    'status' => 'success',
                    'route' => $data['routes'][0],
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => $data['status'],
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching the route.',
            ], 500);
        }
    }
}
