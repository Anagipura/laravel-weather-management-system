def storm_alert(weather_data, city, country):
    risk_score = 0

    wind_speed = weather_data.get('wind', {}).get("speed", 0)  # wind speed
    wind_gust = weather_data.get('wind', {}).get('gust', 0)  # wind gust
    pressure = weather_data.get('main', {}).get('pressure', 1013)  # pressure
    rain = weather_data.get('rain', {}).get('3h', 0)  # past hour rainfall
    clouds = weather_data.get('clouds', {}).get('all', 0) # clouds coverage
    weather_main = weather_data.get('weather', [{}])[0].get('main', '') # main weather situation

    # snow info (not related)

    if wind_speed >= 12:
        # check winds speed
        if wind_speed >= 55:
            risk_score += 35
        elif wind_speed >= 38:
            risk_score += 25
        else:
            risk_score += 10

        # check clouds
        if clouds >= 70:
            risk_score += 10

        # pressure check
        if pressure <= 1000:
            risk_score += 25
        elif pressure <= 1010:
            risk_score += 10

        # check rain
        if rain >= 20:
            risk_score += 10
        elif rain >= 10:
            risk_score += 5

        # check wind gust
        if wind_gust >= 70:
            risk_score += 20
        elif wind_gust >= 50:
            risk_score += 10

        #  check thunderstorms
        if weather_main.lower() == "thunderstorm":
            risk_score += 10

        #  minimum risk score to generate alert is 30
        if risk_score < 40:
            return []

        # severity level based on risk score (max storm risk_score = 110)
        if risk_score >= 85:
            severity = "critical"
        elif risk_score >= 60:
            severity = "high"
        else:
            severity = "medium"

        message = (
            f"Potential storm conditions detected in {city}, {country}. "
            f"Wind speed: {wind_speed} m/s, "
            f"Pressure: {pressure} hPa, "
            f"Rainfall: {rain} mm."
        )

        return [{
            "title": f"Storm Warning - {city}",
            "type": "storm",
            "severity": severity,
            "message": message,
            "risk_score": risk_score
        }]

    else:
        return []
