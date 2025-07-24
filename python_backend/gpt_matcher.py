from openai import OpenAI
import os
from dotenv import load_dotenv
import re
import json
from flask import jsonify

load_dotenv()

client = OpenAI(
  base_url="https://openrouter.ai/api/v1",
  api_key="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",
)

def extract_json(text):
    match = re.search(r'(\[\s*{.*?}\s*\])', text, re.DOTALL)
    if match:
        try:
            return json.loads(match.group(1))
        except json.JSONDecodeError:
            return []
    return []

def get_match_scores(auth_user, waiting_list_users):
    prompt = build_prompt(auth_user, waiting_list_users)
    print(prompt)

    response = client.chat.completions.create(
        model="deepseek/deepseek-r1:free",
        messages=[
            {"role": "system", "content": "You are a helpful assistant that compares user preferences and gives compatibility scores between 0 to 100."},
            {"role": "user", "content": prompt}
        ]
    )
    
    raw_response = response.choices[0].message.content
    print(raw_response)
    scores = extract_json(raw_response)
    return jsonify(scores)


def build_prompt(auth_user, waiting_list_users):
    text = "Compare the preferences of the following users to the authenticated user and give a compatibility score (0–100) for each one.\n\n"
    text += f"Authenticated User:\n{format_user(auth_user)}\n\n"
    text += "Users in Waiting List:\n"
    for i, user in enumerate(waiting_list_users):
        text += f"{i+1}. {user['name']}\n{format_user(user)}\n\n"
    text += "Make sure you just Respond with JSON like: [{\"name\": \"John\", \"score\": 78}, ...]"
    return text


def format_user(user):
    return (
        f"Name: {user['name']}\n"
        f"Smoking: {user['preference']['smoking']}\n"
        f"Alcoholic: {user['preference']['alcoholic']}\n"
        f"Tidiness: {user['preference']['tidiness']}\n"
        f"Preferred Age: {user['preference']['prefered_age']}\n"
        f"Routine Type: {user['preference']['routine_type']}\n"
        f"Room Type: {user['preference']['room_type']}\n"
        f"Socializing: {user['preference']['socializing']}\n"
        f"Cooking Frequency: {user['preference']['cooking_freq']}\n"
        f"Room Temperature: {user['preference']['room_temperature']}\n"
        f"Work Type: {user['preference']['work_type']}\n"
        f"Noise Tolerance: {user['preference']['noise_tolerance']}\n"
        f"Music Genre: {user['preference']['music_genre']}"
    )
    

