from services.intent_detector import user_intent
from services.bot_replies import flood_reply, weather_reply, storm_reply, safety_reply, emergency_reply, donation_reply, general_reply


def process_chat(request):

    maintenance_reply = "Under maintenance! I will be available in few days"
    intent = "general"
    try:
        msg = request.message.lower()
        print(f"message" + msg)
        country = request.country.lower()

        alerts = request.alerts or []

        risk = request.risklevel or {}

        temperature = request.temperature
        humidity = request.humidity
        weather_description = request.weather_description.lower()
        city = request.city.lower()
        wind_speed = request.wind_speed

        alert_titles = " ".join(a.get('title', '').lower() for a in alerts)
        risk_level = risk.get("risklevel", '').lower()

        intent = user_intent(msg)

        # process reply
        if intent == "flood":
            return flood_reply(alert_titles, risk_level, city, country, weather_description, temperature)
        elif intent == "weather":
            return weather_reply(risk_level, country, temperature, humidity, weather_description)
        elif intent == "storm":
            return storm_reply(alert_titles, risk_level, country, weather_description, city, temperature)
        elif intent == "emergency":
            return emergency_reply()
        elif intent == "donation":
            return donation_reply()
        elif intent == "safety":
            return safety_reply(risk_level)
        elif intent == "default":
            return general_reply()

    except Exception as e:
        print(f"Error parsing weather data: {e}")
        return {
            'reply':
                "⚠️ Weather data not available. Please enable location services to get weather updates."
        }

    return {
        "reply":
            maintenance_reply
    }




