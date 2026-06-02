<?php

namespace App\Console\Commands;

use App\Models\Weather_records;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\City;
use function Brotli\compress;

class WeatherMonitorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:monitor';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor weather and generate alerts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cities = City::all();
         //echo $cities . PHP_EOL;
        foreach ($cities as $city) {
            try {
                $response = Http::timeout(15)->withoutVerifying()->get(
                    'https://api.openweathermap.org/data/2.5/weather',[
                        'lat'=> $city->latitude,
                        'lon'=> $city->longitude,
                        'appid' => env('OPENWEATHER_API_KEY'),
                        'units' => 'metric'
                    ]
                );

                if($response->successful()) {
                    $weatherData = $response->json();

                    // append data to the weather_records table
                    Weather_records::create([
                        'city_id' => $city->id,
                        'temperature' => $weatherData['main']['temp'],
                        'humidity' => $weatherData['main']['humidity'],
                        'wind_speed' => $weatherData['wind']['speed'],
                        'pressure' => $weatherData['main']['pressure'],
                        'rainfall' => $weatherData['rain']['1h'] ?? 0, // Rain in last hour (if available)
                        'description' => $weatherData['weather'][0]['description'],
                        'weather_main' => $weatherData['weather'][0]['main'],
                        'recorded_at'=> now(),
                        'created_at'=> now(),
                        'updated_at'=> now()
                    ]);

                    // send weather data to the python server
                    try {
                        $pyResponse = Http::post(
                            'http://127.0.0.1:8001/generateSmartAlerts',[
                                'weatherData'=>$weatherData
                            ]
                        );
                        if($pyResponse->successful()) {
                            $generatedAlerts = $pyResponse->json()['alerts'];
                            //  (if any data received) insert data to the generated_alerts table ..........

                            foreach ($generatedAlerts as $alerts) {

                            }
                        } else {
                            echo 'Python server response failed';
                        }
                    } catch(ConnectionException $e) {
                        \Log::error('PYthon Server Error!'. $e->getMessage());
                    }

                } else {
                   \Log::error('Http Request unsuccessful');
                }

            } catch (ConnectException $e) {
                \Log::error('Can not perform Shedular task! Connection Error'. $e->getMessage());
            }
        }
        return Command::SUCCESS;
    }
}
