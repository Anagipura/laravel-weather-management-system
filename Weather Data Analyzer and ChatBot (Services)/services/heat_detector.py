def heat_alert(weather_data, city, country):
    risk_score = 0
    temp = weather_data.get("main", {}).get('temp', 0) # returns temperature in (C)
    humidity = weather_data.get('main', {}).get('humidity', 0) # humidity

    if temp >= 35:
        risk_score += 30
    elif temp >= 32:
        risk_score += 25
    elif temp >= 30:
        risk_score += 20
    elif temp >= 28:
        risk_score += 15

    if humidity >= 90:
        risk_score += 15
    elif humidity >= 80:
        risk_score += 10
    elif humidity >= 70:
        risk_score += 5

    heat_index = temp + (humidity * 0.1)

    if heat_index >= 45:
        risk_score += 20
    elif heat_index >= 40:
        risk_score += 15
    elif heat_index >= 35:
        risk_score += 10

    if risk_score < 30:
        return []

    # severity level based on risk score (max storm risk_score = 110)
    if risk_score >= 50:
        severity = "critical"
    elif risk_score >= 40:
        severity = "high"
    else:
        severity = "medium"

    message = (
        f"Heatwave conditions detected in {city}, {country}. "
        f"Temperature: {temp}°C, "
        f"Humidity: {humidity}%, "
        f"Heat Index: {heat_index:.1f}. "
        f"Stay hydrated, avoid prolonged outdoor activities, "
        f"and seek shade during peak daytime hours."
    )
    return [{
        "title": f"Heatwave Warning - {city}",
        "type": "heatwave",
        "severity": severity,
        "message": message,
        "risk_score": risk_score
    }]

