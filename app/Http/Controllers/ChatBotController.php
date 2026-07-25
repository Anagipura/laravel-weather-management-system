<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\RiskLevel;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class ChatBotController extends Controller
{

    public function index(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'country' => 'required|string|max:1000',
            'temperature'=> 'required',
            'humidity'=> 'required',
            'weather_description'=> 'required',
            'city'=> 'required',
            'wind_speed'=> 'required'
        ]);

        $country = $request->country;
        // country specific request to the Chatbot
        $alerts = Alert::where('location', $country)->latest()->take(5)->get();
        $riskLevel = RiskLevel::where('country', $country)->latest()->first();

        $weatherData = [];

        // Send all the required parameters to the AI Service Port
        try {
            $response = Http::post('http://127.0.0.1:8001/chat', [
                'message' => $request->message,
                'country' => $country?? 'Sri Lanka', //default location 'Sri Lanka'
                'alerts' => $alerts ? $alerts->toArray() : [],
                'risklevel' => $riskLevel ? $riskLevel->toArray() : [],
                'temperature'=> $request->temperature,
                'humidity'=> $request->humidity,
                'weather_description'=> $request->weather_description,
                'city'=> $request->city,
                'wind_speed'=> $request->wind_speed,
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'reply' => 'Chatbot service unavailable. Check if it is running.'
                ], 500);
            }

            // return JSON with "reply"
            $reply = $response->json();

            return response()->json([
               'success'=> true,
                'reply'=> $reply['reply']
            ]);

        } catch (\Exception $e) {
            \Log::error('ChatBot error: ' . $e->getMessage());

            if($request->wantsJson()) {
                return response()->json([
                    'success'=> false,
                    'reply'=> 'Server Error!'
                ], 500);
            }

        }
    }
}
