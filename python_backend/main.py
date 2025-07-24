from flask import Flask, request, jsonify
from gpt_matcher import get_match_scores
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

@app.route('/api/match-scores', methods=['POST'])
def match_scores():
    data = request.json
    auth_user = data['auth_user']
    waiting_list_users = data['waiting_list_users']
    
    try:
        result = get_match_scores(auth_user, waiting_list_users)
        return jsonify({"status": "success", "data": result})
    except Exception as e:
        return jsonify({"status": "error", "message": str(e)}), 500


if __name__ == '__main__':
   app.run(debug=True, host='127.0.0.1', port=5000)
