from services.flood_detector import flood_alert
from services.storm_detector import storm_alert
from services.heat_detector import heat_alert


def analyze_weather(request):
    weather_data = request.weatherData
    alerts = [] # initial alert list

    alerts.extend(flood_alert(weather_data))
    alerts.extend(storm_alert(weather_data))
    alerts.extend(heat_alert(weather_data))

    print(alerts)
    return {
        "alerts": [
            alerts
        ]
    }



