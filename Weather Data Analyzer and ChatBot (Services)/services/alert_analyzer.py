from services.flood_detector import flood_alert
from services.storm_detector import storm_alert
from services.heat_detector import heat_alert


def analyze_weather(request):
    weather_data = request.weatherData
    city = request.city
    country = request.country
    risk_score = 0
    alerts = [] # initial alert list

    alerts.extend(flood_alert(weather_data, city, country))
    alerts.extend(storm_alert(weather_data, city, country))
    alerts.extend(heat_alert(weather_data, city, country, risk_score))

    print(alerts)
    return {
        "alerts": [
            alerts
        ]
    }



