def flood_alert(weather_data):
    rainfall = weather_data.get("rain", {}).get("1h", 0)  # return rainfall in mm/hr

    if rainfall >= 10:
        return [{
            "title": "Severe Flood Alert",
            "severity": "high",
            "description":
                "Extreme rainfall detected"
        }]
    elif 10 > rainfall > 2.6:
        return [{
            "title": "Flood Warning",
            "severity": "medium",
            "description":
                "Heavy rainfall detected"
        }]
    return []
