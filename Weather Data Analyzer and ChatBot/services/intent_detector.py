def user_intent(msg):
    if any(word in msg for word in [
        "flood",
        "flooding",
        "overflow"
    ]):
        return "flood"

    elif any(word in msg for word in [
        "rain",
        "weather",
        "temperature"
    ]):
        return "weather"

    elif any(word in msg for word in [
        "storm",
        "wind",
        "cyclone"
    ]):
        return "storm"

    elif any(word in msg for word in [
        "donate",
        "donation",
        "help victims"
    ]):
        return "donation"

    elif any(word in msg for word in [
        "safe",
        "safety",
        "protect"
    ]):
        return "safety"

    elif any(word in msg for word in [
        "emergency",
        "help",
        "ambulance"
    ]):
        return "emergency"

    return "general"
