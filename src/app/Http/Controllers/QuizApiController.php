<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizApiController extends Controller
{
    public function checkAnswer(Request $request)
    {
        //フロントから送られた答えを受け取る
        $userAnswer = $request->input('answer');
        $a = $request->input('a');
        $b = $request->input('b');

        $correctAnswer = $a * $b;

        $isCorrect = ($userAnswer == $correctAnswer);

        // JSON形式で返す
        return response()->json([
            'correct' => $isCorrect,
            'correctAnswer' => $correctAnswer
        ]);
    }

    public function nextQuestion()
    {
        $a = rand(1, 9);
        $b = rand(1, 9);
        $correct = $a * $b;

        // 間違いの選択肢を作成（正解以外の数字）
        do {
            $wrong = rand(1, 81); // 9x9まで
        } while ($wrong == $correct);

        // 正解と不正解をランダムに配置
        $answers = [$correct, $wrong];
        shuffle($answers);

        return response()->json([
            'a' => $a,
            'b' => $b,
            'correct' => $correct,
            'answers' => $answers,
        ]);
    }
}
