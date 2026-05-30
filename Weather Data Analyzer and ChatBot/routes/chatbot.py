from fastapi import APIRouter
from models.schemas import ChatRequest
from services.chatbot_services import process_chat

router = APIRouter()


@router.post("/chat")
def chatBot(request: ChatRequest):
    return process_chat(request)
