<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\userController;
use App\Models\Alert;
use App\Models\RiskLevel;
use Carbon\Carbon;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;

class weatherController extends controller {
     public function index(Request $request) {
         // catch parameters
         $lon = $request->longitude;
         $lat = $request->latitude;

         // default location
         $location = 'colombo';

         // manage API call
         try {
             if($lat && $lon) {
                 $response = Http::withoutVerifying()->get(
                     'https://api.openweathermap.org/data/2.5/weather',[
                         'lat' => $lat,
                         'lon' => $lon,
                         'appid' => env('OPENWEATHER_API_KEY'),
                         'units' => 'metric'
                     ]
                 );

             } else {
                 $response = Http::withoutVerifying()->get('https://api.openweathermap.org/data/2.5/weather', [
                     'q'=>$location,
                     'appid'=>env('OPENWEATHER_API_KEY'),
                     'units'=>'metric'
                 ]);
             }

             if(!$response->successful()) {
                 if($request->wantsJson()) {
                     return response()->json([
                         'error' => 'API Failed!'
                     ]);
                 }
                 return view('weather')->with('error', 'API call failed!');
             }
             $weather = $response->json();

             // pass weather api response to the AI service
             try {
                 $aiServiceResponse = Http::post('http://127.0.0.1:8001/chat', [
                     'weatherData' => $weather
                 ]);
             } catch (\Exception $e) {
                 \Log::error("AI service unavailable : ". $e->getMessage());
             }

         } catch(ConnectException $e) {
             if($request->wantsJson()) {
                return response()->json([
                    'error' => 'No internet Connection or Unable to call API!'
                ]);
             }
             return view('weather')->with('error', 'No internet Connection or Unable to call API!');

         }

         // get alerts related to that location (country specific)
         $country = $weather['sys']['country'] ?? null;

         //location(country) specific alerts
         $alerts = Alert::where('location', $country)->latest()->get();

         // manage risk level
         $riskLevel = RiskLevel::where('country', $country)->latest()->first();

         // AJAX RESPONSE
         if ($request->wantsJson()) {
            return $response;
         }
         // return weatherData(default) , updated riskLevel and alerts
        return view('weather', compact('weather', 'alerts', 'riskLevel', 'location'));
     }

}





