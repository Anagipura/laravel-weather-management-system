import logging

from services.intent_detector import user_intent
from services.bot_replies import (
    flood_reply,
    weather_reply,
    storm_reply,
    safety_reply,
    emergency_reply,
    donation_reply,
    general_reply
)

logger = logging.getLogger(__name__)


def process_chat(request):
    """
    Main chatbot processing function.

    Flow:
        User Message
              ↓
        Intent Detection (Gemini)
              ↓
        Local Fallback (if needed)
              ↓
        Reply Routing
              ↓
        Return Reply
    """

    try:
        # User Message
        msg = (request.message or "").strip()

        if not msg:
            return {
                "reply": "Please enter a message."
            }

        # User Context
        country = (request.country or "").lower()
        city = (request.city or "").lower()

        temperature = request.temperature
        humidity = request.humidity
        wind_speed = request.wind_speed

        weather_description = (
            request.weather_description or ""
        ).lower()

        alerts = request.alerts or []
        risk = request.risklevel or {}

        alert_titles = " ".join(
            alert.get("title", "").lower()
            for alert in alerts
        )

        risk_level = (
            risk.get("risklevel", "")
        ).lower()

        # Detect Intent
        intent_data = user_intent(msg)

        intent = intent_data["intent"]
        confidence = intent_data["confidence"]

        logger.info(
            f"Intent={intent} Confidence={confidence}"
        )

        # Unknown Intent
        if intent == "default" and confidence == "low":

            return {
                "reply":
                    "I'm not completely sure what you mean. "
                    "Could you rephrase your question?"
            }

        # Reply Router
        reply_handlers = {

            "flood": lambda: flood_reply(
                alert_titles,
                risk_level,
                city,
                country,
                weather_description,
                temperature
            ),

            "weather": lambda: weather_reply(
                risk_level,
                country,
                temperature,
                humidity,
                weather_description
            ),

            "storm": lambda: storm_reply(
                alert_titles,
                risk_level,
                country,
                weather_description,
                city,
                temperature
            ),

            "emergency": emergency_reply,

            "donation": donation_reply,

            "safety": lambda: safety_reply(
                risk_level
            ),

            "default": general_reply
        }

        handler = reply_handlers.get(
            intent,
            general_reply
        )

        reply = handler()

        # If the reply function already returns a dictionary
        if isinstance(reply, dict):
            return reply

        # Otherwise wrap it
        return {
            "reply": reply
        }

    except Exception:

        logger.exception(
            "Chatbot processing failed."
        )

        return {
            "reply":
                "⚠️ Sorry, I'm currently unable to process your request. "
                "Please try again in a few moments."
        }
