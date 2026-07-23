def flood_alert(weather_data, city, country):
    risk_score = 0
    rainfall = weather_data.get("rain", {}).get("1h", 0)  # return rainfall in mm/hr
    humidity = weather_data.get('main', {}).get('humidity', 0)
    pressure = weather_data.get("main", {}).get("pressure", 1013)

    if rainfall >= 10:
        # rainfall
        if rainfall >= 50:
            risk_score += 50
        elif rainfall >= 25:
            risk_score += 30
        elif rainfall >= 10:
            risk_score = 15

        # humidity
        if humidity >= 90:
            risk_score = 15

        # Pressure
        if pressure <= 1000:
            risk_score += 15

        #  minimum risk score to generate alert is 30
        if risk_score < 30:
            return []

        # severity level based on risk score
        if risk_score >= 75:
            severity = "critical"
        elif risk_score >= 50:
            severity = "high"
        else:
            severity = "medium"

        return [{
            "title": f"Flood Warning - {city}",
            "type": "flood",
            "severity": severity,
            "message": f"Potential flood conditions detected in {city}, {country}.",
            "risk_score": risk_score
        }]
    else:
        return []


#
