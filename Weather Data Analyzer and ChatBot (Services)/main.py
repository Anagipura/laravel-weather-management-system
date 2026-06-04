from fastapi import FastAPI
from routes.chatbot import router as chatbot_router
from routes.alerts import router as alert_generator_router

app = FastAPI()

app.include_router(chatbot_router)
app.include_router(alert_generator_router)


@app.get("/")
def home():
    return {"message": "AI service running"}
