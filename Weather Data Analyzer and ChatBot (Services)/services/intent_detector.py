import json
import logging
import os

from dotenv import load_dotenv
from google import genai
from google.genai import types

# Configuration
load_dotenv()

logger = logging.getLogger(__name__)

client = genai.Client(
    api_key=os.getenv("GEMINI_API_KEY")
)

DEFAULT_INTENT = "default"
DEFAULT_CONFIDENCE = "low"

# Allowed Intents
ALLOWED_INTENTS = [
    "flood",
    "storm",
    "weather",
    "emergency",
    "donation",
    "safety",
    "default"
]

CONFIDENCE_LEVELS = [
    "high",
    "medium",
    "low"
]

# Gemini JSON Schema
INTENT_SCHEMA = {
    "type": "OBJECT",
    "properties": {
        "intent": {
            "type": "STRING",
            "enum": ALLOWED_INTENTS
        },
        "confidence": {
            "type": "STRING",
            "enum": CONFIDENCE_LEVELS
        }
    },
    "required": [
        "intent",
        "confidence"
    ]
}

# Gemini Prompt

SYSTEM_PROMPT = """
You are an intent classification engine for a Disaster Management System.

Your ONLY task is to classify the user's message.

Available intents:

- flood
- storm
- weather
- emergency
- donation
- safety
- default

Rules:

1. Return ONLY valid JSON.
2. Never explain.
3. Never use Markdown.
4. Return exactly ONE intent.
5. If uncertain return "default".
6. If multiple intents appear, choose the PRIMARY one.

Example:

User:
Will Colombo flood today?

Output:
{
    "intent":"flood",
    "confidence":"high"
}
"""

# Local Keyword Fallback

INTENT_KEYWORDS = {

    "flood": [
        "flood",
        "flooding",
        "overflow",
        "overflowing",
        "water level",
        "inundation"
    ],

    "storm": [
        "storm",
        "cyclone",
        "hurricane",
        "tornado",
        "wind",
        "strong wind"
    ],

    "weather": [
        "weather",
        "forecast",
        "temperature",
        "rain",
        "cloud",
        "sunny"
    ],

    "emergency": [
        "help",
        "sos",
        "ambulance",
        "rescue",
        "trapped",
        "emergency"
    ],

    "donation": [
        "donate",
        "donation",
        "contribute",
        "support victims"
    ],

    "safety": [
        "safe",
        "safety",
        "protect",
        "precaution",
        "evacuation"
    ]

}


def fallback_intent_detector(msg: str) -> str:
    """
    Local keyword intent detector.
    Used whenever Gemini is unavailable.
    """

    msg = msg.lower()
    for intent, keywords in INTENT_KEYWORDS.items():
        if any(keyword in msg for keyword in keywords):
            return intent
    return DEFAULT_INTENT


# Gemini Intent Detection
def user_intent(msg: str) -> dict:
    """
    Detect user intent using Gemini.
    Falls back to:
        1. Next Gemini model
        2. Local keyword detector
    """

    if not msg:
        return {
            "intent": DEFAULT_INTENT,
            "confidence": DEFAULT_CONFIDENCE
        }

    FALLBACK_MODELS = [
        "gemini-3.5-flash",
        "gemini-3.6-flash",
        "gemini-2.5-flash-lite",
        "gemini-3.0-pro",
        "gemini-2.5-flash-image-preview"
    ]

    for model in FALLBACK_MODELS:

        try:
            logger.info(f"Trying Gemini model: {model}")
            response = client.models.generate_content(
                model=model,
                contents=msg,
                config=types.GenerateContentConfig(
                    system_instruction=SYSTEM_PROMPT,
                    response_mime_type="application/json",
                    response_schema=INTENT_SCHEMA,
                    thinking_config=types.ThinkingConfig(
                        thinking_budget=0
                    )
                )
            )
            try:
                result = json.loads(response.text)
            except json.JSONDecodeError:
                logger.warning(
                    "Gemini returned invalid JSON."
                )
                continue
            intent = result.get(
                "intent",
                DEFAULT_INTENT
            )

            confidence = result.get(
                "confidence",
                DEFAULT_CONFIDENCE
            )

            # Validate intent
            if intent not in ALLOWED_INTENTS:
                logger.warning(
                    f"Unknown intent received: {intent}"
                )
                intent = DEFAULT_INTENT

            # Validate confidence
            if confidence not in CONFIDENCE_LEVELS:
                logger.warning(
                    f"Unknown confidence: {confidence}"
                )
                confidence = DEFAULT_CONFIDENCE

            logger.info(
                f"Intent={intent}, Confidence={confidence}"
            )
            return {
                "intent": intent,
                "confidence": confidence

            }
        except Exception as e:
            logger.warning(
                f"Gemini model {model} failed: {e}"
            )
            continue

    # All Gemini models failed
    logger.warning(
        "Using local keyword fallback."
    )
    return {
        "intent": fallback_intent_detector(msg),
        "confidence": DEFAULT_CONFIDENCE
    }
