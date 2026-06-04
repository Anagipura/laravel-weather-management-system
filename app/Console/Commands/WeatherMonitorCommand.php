<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Pending_alerts;
use App\Models\Weather_records;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherMonitorCommand extends Command
{
    /**
     * Command Signature
     */
    protected $signature = 'weather:monitor';

    /**
     * Command Description
     */
    protected $description = 'Monitor weather conditions and generate smart alerts';

    /**
     * Execute the command
     */
    public function handle()
    {
        $cities = City::where('is_active', true)->get();

        foreach ($cities as $city) {

            try {

                // Fetch weather data
                $response = Http::timeout(15)
                    ->withoutVerifying()
                    ->get(
                        'https://api.openweathermap.org/data/2.5/weather',
                        [
                            'lat' => $city->latitude,
                            'lon' => $city->longitude,
                            'appid' => env('OPENWEATHER_API_KEY'),
                            'units' => 'metric'
                        ]
                    );

                if (!$response->successful()) {

                    Log::error(
                        "OpenWeather API request failed for city: {$city->cityName}"
                    );

                    continue;
                }

                $weatherData = $response->json();

                // Store weather record
                $weatherRecord = Weather_records::create([
                    'city_id'       => $city->id,
                    'temperature'   => $weatherData['main']['temp'],
                    'humidity'      => $weatherData['main']['humidity'],
                    'wind_speed'    => $weatherData['wind']['speed'],
                    'pressure'      => $weatherData['main']['pressure'],
                    'rainfall'      => $weatherData['rain']['1h'] ?? 0,
                    'description'   => $weatherData['weather'][0]['description'],
                    'weather_main'  => $weatherData['weather'][0]['main'],
                    'recorded_at'   => now(),
                ]);

                Log::info(
                    "Weather data stored for city: {$city->cityName}"
                );

                // Send data to Python Alert Analyzer
                try {

                    $pyResponse = Http::timeout(10)->post(
                        'http://127.0.0.1:8001/generateSmartAlerts',
                        [
                            'weatherData' => $weatherData
                        ]
                    );

                    if (!$pyResponse->successful()) {

                        Log::error(
                            "Python analyzer failed. Status: " .
                            $pyResponse->status()
                        );

                        continue;
                    }

                    $generatedAlerts =
                        $pyResponse->json()['alerts'] ?? [];

                    Log::info(
                        'Generated Alerts',
                        $generatedAlerts
                    );

                    foreach ($generatedAlerts as $alert) {

                        // Prevent duplicate pending alerts
                        $exists = Pending_alerts::where(
                            'city_id',
                            $city->id
                        )
                            ->where(
                                'title',
                                $alert['title']
                            )
                            ->where(
                                'status',
                                'pending'
                            )
                            ->exists();

                        if ($exists) {

                            Log::info(
                                "Duplicate alert skipped for city: {$city->cityName}"
                            );

                            continue;
                        }

                        Pending_alerts::create([

                            'city_id' => $city->id,

                            'weather_record_id' =>
                                $weatherRecord->id,

                            'title' =>
                                $alert['title']
                                ?? 'Generated Alert',

                            'message' =>
                                $alert['message']
                                ?? 'Weather anomaly detected.',

                            'type' =>
                                $alert['type']
                                ?? 'general',

                            'location' =>
                                $city->country,

                            'severity' =>
                                $alert['severity']
                                ?? 'medium',

                            'risk_score' =>
                                $alert['risk_score']
                                ?? 50,

                            'status' =>
                                'pending',

                            'source' =>
                                'python_alert_analyzer'
                        ]);

                        Log::info(
                            "Pending alert created for city: {$city->cityName}"
                        );
                    }

                } catch (ConnectionException $e) {

                    Log::error(
                        'Python Service Connection Error: ' .
                        $e->getMessage()
                    );
                }

            } catch (\Exception $e) {

                Log::error(
                    "Weather Monitor Error ({$city->cityName}): " .
                    $e->getMessage()
                );
            }
        }

        $this->info('Weather monitoring completed successfully.');

        return Command::SUCCESS;
    }
}
