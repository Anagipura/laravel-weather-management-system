def storm_alert(weather_data):

    wind_speed = weather_data.get('wind', {}).get("speed", 0)

    if wind_speed >= 20:
        return [{
            "title": "Storm Warning",
            "severity": "high",
            "description":
                "Strong winds detected"
        }]
    return []
