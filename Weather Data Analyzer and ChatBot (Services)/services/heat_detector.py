def heat_alert(weather_data):
    temp = weather_data.get("main", {}).get('temp', 0) # returns temperature

    if temp >= 30:
        return [{
            "title": "Heat Wave Alert",
            "severity": "medium",
            "description":
                "Extreme temperatures detected"
        }]

    return []
