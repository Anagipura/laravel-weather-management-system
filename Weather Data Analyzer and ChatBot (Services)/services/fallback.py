# fallback messages incase a chatbot error
import logging

logger = logging.getLogger(__name__)

DEFAULT_CONFIDENCE = 'low'


# network error
# quota_exceeded
# unavailable(503)
# invalid_response
# unsupported_question
# generic_error

def network_error():
    # AI service can not access for due to a network interruption
    logger.warning("Unable to reach Gemini API")

    return {
        "reply": (
            "Unable to connect to the AI service due to a Network Connection issue!"
            "Please Check your Internet Connection."
        ),
        "confidence": DEFAULT_CONFIDENCE
    }


def quota_exceeded():
    logger.warning("Gemini API quota exceeded.")

    return {
        "reply": (
            "I'm currently experiencing high demand and cannot process "
            "your request right now. Please try again in a few minutes. "
            "If this is an emergency, please follow official Disaster "
            "Management Centre instructions or contact local emergency services."
        ),
        "confidence": DEFAULT_CONFIDENCE
    }


def service_unavailable():
    # Gemini service is temporarily unavailable.

    logger.warning("Gemini service unavailable.")

    return {
        "reply": (
            "The AI assistant is temporarily unavailable. "
            "Please try again shortly."
        ),
        "confidence": DEFAULT_CONFIDENCE
    }


def invalid_response():
    # Gemini returned malformed JSON.

    logger.error("Invalid response received from Gemini.")

    return {
        "reply": (
            "I couldn't properly understand the response from the AI service. "
            "Please try asking your question again."
        ),
        "confidence": DEFAULT_CONFIDENCE
    }


def unsupported_question():

    # Question is outside the chatbot's supported domain.
    return {
        "reply": (
            "I'm designed to assist with weather conditions, disaster alerts, "
            "emergency preparedness, and public safety. "
            "Please ask a question related to disaster management."
        ),
        "confidence": DEFAULT_CONFIDENCE
    }


def generic_error():
    # unknown Exception
    logger.exception("Unexpected chatbot error.")

    return {
        "reply": (
            "Something went wrong while processing your request. "
            "Please try again later."
        ),
        "confidence": DEFAULT_CONFIDENCE
    }

