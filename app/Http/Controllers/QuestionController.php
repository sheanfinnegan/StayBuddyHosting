<?php

// app/Http/Controllers/QuestionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function show($id)
{
    $question = Question::find($id);

    if (!$question) {
        return redirect()->route('questionnaire.show', ['id' => 1])
            ->with('error', 'Pertanyaan tidak ditemukan.');
    }

    $userPreference = UserPreference::where('user_id', Auth::id())->first();
    $selectedAnswer = null;

    if ($userPreference) {
        // Ambil jawaban dari preferensi user yang sudah tersimpan
        $preferenceData = [
            1 => $userPreference->smoking,
            2 => $userPreference->alcoholic,
            3 => $userPreference->tidiness,
            4 => $userPreference->prefered_age,
            5 => $userPreference->routine_type,
            6 => $userPreference->room_type,
            7 => $userPreference->socializing,
            8 => $userPreference->cooking_freq,
            9 => $userPreference->room_temperature,
            10 => $userPreference->work_type,
            11 => $userPreference->noise_tolerance,
            12 => $userPreference->music_genre,
        ];

        $selectedAnswer = $preferenceData[$id] ?? null;

        // Simpan ke session supaya next/previous tetap jalan
        session()->put("answers.$id", $selectedAnswer);
    } else {
        // Ambil dari session kalau belum pernah isi preference
        $selectedAnswer = session("answers.$id", null);
    }

    return view('questionnaire', compact('question', 'selectedAnswer'));
}


    public function next(Request $request)
    {
        $questionId = $request->input('question_id');
    $answer = $request->input('answer');

    $progressBarQuestions = [3, 7, 8, 11];

    if (in_array($questionId, $progressBarQuestions)) {
        $answer = (int) $answer;
    }


    // Simpan jawaban ke session
    session()->put("answers.$questionId", $answer);

    // Redirect ke pertanyaan selanjutnya
    return redirect()->route('questionnaire.show', ['id' => $questionId + 1]);
    }

    public function submit(Request $request)
{
    $questionId = $request->input('question_id');
    $answer = $request->input('answer');

    $progressBarQuestions = [3, 7, 8, 11];

    if (in_array($questionId, $progressBarQuestions)) {
        $answer = (int) $answer;
    }

    session()->put("answers.$questionId", $answer);

    $answers = session('answers');

    // Cek apakah preference user sudah ada
    $preference = UserPreference::where('user_id', Auth::id())->first();

    if (!$preference) {
        $preference = new UserPreference();
        $preference->user_id = Auth::id();
    }

    $preference->smoking = $answers[1] ?? null;
    $preference->alcoholic = $answers[2] ?? null;
    $preference->tidiness = $answers[3] ?? null;
    $preference->prefered_age = $answers[4] ?? null;
    $preference->routine_type = $answers[5] ?? null;
    $preference->room_type = $answers[6] ?? null;
    $preference->socializing = $answers[7] ?? null;
    $preference->cooking_freq = $answers[8] ?? null;
    $preference->room_temperature = $answers[9] ?? null;
    $preference->work_type = $answers[10] ?? null;
    $preference->noise_tolerance = $answers[11] ?? null;
    $preference->music_genre = $answers[12] ?? null;

    $preference->save();

    session()->forget('answers');
    

    return redirect()->route('profile')->with('loadPreference', true);
}

}
