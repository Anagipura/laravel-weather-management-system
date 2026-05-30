import json


def flood_reply(alert_titles, risk_level, city, country, weather_description, temperature):
    # High risk flood + rain
    if 'flood' in alert_titles and risk_level == 'high' and 'rain' in weather_description:
        return {
            'reply': f"I'm detecting a severe flood alert in {city}, {country}. "
                     f"The risk level is high, and with ongoing rain ({weather_description}, {temperature}°C), "
                     f"conditions are dangerous right now. I strongly advise avoiding any low-lying areas, "
                     f"never driving through flooded roads, and following local emergency instructions immediately."
        }

    # Medium/low risk with flood alert + rain
    elif (
            'flood' in alert_titles and
            (risk_level == 'medium' or risk_level == 'low') and
            'rain' in weather_description
    ):
        return {
            'reply': f"There's a flood watch currently active for {city}, {country}. "
                     f"Risk level is {risk_level}, and rain is in the forecast ({weather_description}, {temperature}°C). "
                     f"While it's not an emergency yet, I recommend staying alert near rivers or drainage areas, "
                     f"and keeping an eye on local weather updates throughout the day."
        }

    # Rain but no flood alert (medium/low risk)
    elif (
            (risk_level == 'medium' or risk_level == 'low') and
            'rain' in weather_description
    ):
        return {
            'reply': f"It's currently rainy in {city}, {country} ({weather_description}, {temperature}°C), "
                     f"but there's no official flood alert issued. The general risk level is {risk_level}. "
                     f"Still, I'd suggest being cautious of possible waterlogging in your area—better safe than sorry."
        }

    # Default: no threats
    else:
        return {
            'reply': f"Good news! No major flood threats are detected in {country} right now. "
                     f"Current weather shows {weather_description} with a temperature of {temperature}°C. "
                     f"You can go about your day, but I'll keep monitoring in case anything changes."
        }


def weather_reply(risk_level, country, temperature, humidity, weather_description):
    if risk_level == 'high':
        return {
            'reply': f"I'm seeing unstable weather conditions in {country} right now. "
                     f"With {weather_description}, {temperature}°C, and humidity at {humidity}%, "
                     f"it's best to stay cautious. I recommend following official weather updates "
                     f"and avoiding unnecessary travel until conditions improve."
        }

    elif risk_level == 'medium':
        return {
            'reply': f"There's moderate weather activity happening in {country} at the moment. "
                     f"Currently, we have {weather_description} with a temperature of {temperature}°C "
                     f"and {humidity}% humidity. You should be fine for most activities, "
                     f"but I'd suggest carrying an umbrella or jacket just in case, and driving carefully."
        }

    else:
        return {
            'reply': f"Good news! The weather in {country} looks stable and calm right now. "
                     f"Expect {weather_description} with temperatures around {temperature}°C "
                     f"and humidity at {humidity}%. It should be a pleasant day—feel free to enjoy outdoor plans, "
                     f"though I'll let you know if anything changes."
        }


def storm_reply(alert_titles, risk_level, country, weather_description, city, temperature):
    if 'storm' in alert_titles and risk_level == 'high':
        return {
            'reply': f"I'm detecting a severe storm warning active in {country}, specifically affecting {city}. "
                     f"Current conditions show {weather_description} with temperatures at {temperature}°C. "
                     f"This is serious—please stay indoors, secure any loose outdoor items, avoid unnecessary travel, "
                     f"and keep an eye on emergency broadcasts until the storm passes."
        }

    elif 'storm' in alert_titles and risk_level == 'medium':
        return {
            'reply': f"There's a moderate storm alert in parts of {country}, including {city}. "
                     f"We're seeing {weather_description} and {temperature}°C right now. "
                     f"While it's not extreme, strong winds and unsettled conditions are possible. "
                     f"I'd recommend staying indoors if you can, or at least being very careful if you need to go out."
        }

    else:
        return {
            'reply': f"Good news—I'm not detecting any severe storm activity in {country} or {city} right now. "
                     f"Current weather shows {weather_description} with a temperature of {temperature}°C. "
                     f"You're safe to go about your normal routine, but I'll keep monitoring the skies for you."
        }


def safety_reply(risk_level, hazard_type="disaster", location="your area"):
    if risk_level == 'high':
        return {
            'reply': f"I need to be direct with you—there's a high {hazard_type} risk detected in {location} right now. "
                     f"Please take this seriously: keep your emergency supplies ready (water, food, medications, flashlight, batteries), "
                     f"charge your devices, know your nearest evacuation routes, and follow any evacuation instructions from local authorities immediately. "
                     f"Your safety is the priority right now."
        }

    elif risk_level == 'medium':
        return {
            'reply': f"There's a moderate {hazard_type} risk in {location} at the moment. "
                     f"While it's not an emergency yet, I recommend staying aware of weather and alert updates, "
                     f"avoiding unnecessary travel—especially through risky areas—and having a basic emergency kit on hand just in case. "
                     f"Better to be prepared than caught off guard."
        }

    else:
        return {
            'reply': f"Good news! Current safety conditions in {location} appear stable with no major {hazard_type} threats. "
                     f"That said, I always recommend staying in the habit of monitoring alerts regularly—being prepared never hurts. "
                     f"Enjoy your day, and I'll keep an eye on things for you."
        }


def emergency_reply(emergency_type="emergency", location="your area"):
    return {
        'reply': f"If you're facing a {emergency_type} situation in {location}, please don't wait—reach out for help immediately. "
                 f"You can contact local disaster management authorities, police, ambulance services, or nearby hospitals right away. "
                 f"If you're unsure of the numbers, try calling your country's general emergency number (like 911, 112, or 999). "
                 f"Stay calm, share your exact location, and follow their instructions. I'm here to assist with information, but please prioritize reaching live emergency services."
    }


def donation_reply(disaster_type="disaster", affected_region="affected areas"):
    return {
        'reply': f"I appreciate you wanting to help! You can support communities affected by the {disaster_type} in {affected_region} "
                 f"through the donation section in our Disaster Management System. Every contribution, whether big or small, "
                 f"makes a real difference in getting supplies, shelter, and medical aid to those who need it most."
    }


def general_reply():
    return {
        'reply': f"Thanks for asking! I'm your AI disaster management assistant, and I can help you with quite a few things related to {user_query}. "
                 f"Specifically, I can provide: flood risk alerts, severe weather updates (storms, rain, etc.), safety guidance based on risk levels, "
                 f"emergency contact recommendations, donation opportunities for affected communities, and general disaster preparedness advice. "
                 f"Just let me know what you'd like to check—whether it's current conditions in a specific city, safety tips, or how to help others."
    }
