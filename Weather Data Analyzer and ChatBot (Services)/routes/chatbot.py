from fastapi import APIRouter
from models.schemas import ChatRequest
from services.gemini_service import process_payload

router = APIRouter()


@router.post("/chat")
def chatBot(request: ChatRequest):
    return process_payload(request)
