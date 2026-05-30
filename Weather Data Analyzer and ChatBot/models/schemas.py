from typing import Optional
from pydantic import BaseModel


class ChatRequest(BaseModel):
    message: str
    country: Optional[str] = "Sri Lanka"
    city: Optional[str] = None

    alerts: Optional[list] = None
    risklevel: Optional[dict] = None

    temperature: Optional[float] = None
    humidity: Optional[float] = None
    wind_speed: Optional[float] = None
    weather_description: Optional[str] = None
