from fastapi import APIRouter
from models.schemas import SmartAlertRequest
from services.alert_analyzer import analyze_weather

router = APIRouter()


@router.post("/generateSmartAlerts")
def generate_alerts(request: SmartAlertRequest):
    return analyze_weather(request)
