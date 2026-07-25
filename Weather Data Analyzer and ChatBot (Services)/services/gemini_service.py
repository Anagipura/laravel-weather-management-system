import logging
import os
import json

from google import genai
from google.genai import types
from dotenv import load_dotenv

from services import fallback
from services.prompt import SYSTEM_PROMPT

load_dotenv()

logger = logging.getLogger(__name__)

client = genai.Client(
    api_key=os.getenv("GEMINI_API_KEY")
)
for model in client.models.list():
    print(model.name)

DEFAULT_CONFIDENCE = "low"

RETRYABLE_STATUS_CODES = {
    404, 503, 500, 429
}

MODELS = [
    model.strip()
    for model in os.getenv(
        "FALLBACK_MODELS",
        "gemini-3.6-flash"
    ).split(",")
]

CONFIDENCE_TYPES = [
    "high",
    "medium",
    "low"
]
RESPONSE_SCHEMA = {
    "type": "OBJECT",
    "properties": {
        "reply": {
            "type": "STRING"
        },
        "confidence": {
            "type": "STRING",
            "enum": CONFIDENCE_TYPES
        }
    },
    "required": [
        "reply",
        "confidence"
    ]
}


def process_payload(request):
    if not request.message:
        return fallback.generic_error()

    try:
        payload = f"""
        User message {request.message}
        Current Environment
        City: {request.city}
        Country: {request.country}
        Temperature: {request.temperature} °C
        Humidity: {request.humidity} %
        Wind Speed:{request.wind_speed} m/s
        Weather Description:{request.weather_description}
        Risk Level:{json.dumps(request.risklevel, indent=2)}
        Active Alerts: {json.dumps(request.alerts, indent=2)}
        """

        response = _generate_with_fallback(payload)
        return _parse_response(response)
    except Exception as e:
        return _handle_exception(e)


def _generate_with_fallback(payload):
    last_exception = None
    for model in MODELS:
        try:
            logger.info(
                f"Trying Gemini model: {model}"
            )
            response = client.models.generate_content(
                model=model,
                contents=payload,
                config=types.GenerateContentConfig(
                    system_instruction=SYSTEM_PROMPT,
                    response_mime_type="application/json",
                    response_schema=RESPONSE_SCHEMA,
                    thinking_config=types.ThinkingConfig(
                        thinking_budget=1
                    )
                )
            )
            logger.info(
                f"Model {model} succeeded."
            )
            print(f"model {model} successful")
            return response
        except Exception as e:
            print(f"model {model} failed")
            last_exception = e
            code = getattr(e, "code", None)
            if code in RETRYABLE_STATUS_CODES:
                continue
            raise
    raise last_exception


def _parse_response(response):
    try:
        result = json.loads(response.text)
        return {
            "reply": result.get(
                "reply",
                "Sorry, I couldn't generate a response."
            ),
            "confidence": result.get(
                "confidence",
                DEFAULT_CONFIDENCE
            )
        }

    except json.JSONDecodeError:
        logger.exception(
            "Invalid JSON received from Gemini."
        )
        return fallback.invalid_response()


def _handle_exception(error):

    code = getattr(error, "code", None)
    logger.exception(error)

    if code == 429:
        return fallback.quota_exceeded()
    elif code == 503:
        return fallback.service_unavailable()
    elif code == 404:
        return fallback.service_unavailable()
    return fallback.generic_error()

