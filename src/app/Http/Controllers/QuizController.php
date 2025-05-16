<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show()
    {
        $a = rand(1, 9);
        $b = rand(1, 9);
        $correctAnswer = $a * $b;

        do {
            $wrongAnswer = rand(1, 81); //9*9=81の中からランダムに代入
        } while ($wrongAnswer == $correctAnswer);

        $answers = [$correctAnswer, $wrongAnswer];
        shuffle($answers);

        return view('quiz.show', compact('a', 'b', 'correctAnswer', 'answers'));
    }

    public function check(Request $request)
    {
        $a = $request->input('a');
        $b = $request->input('b');
        $answer = $request->input('answer');
        $correct = $a * $b;
        $isCorrect = $answer == $correct;

        // スコア保存（後ほど）
        return view('quiz.result', compact('a', 'b', 'answer', 'correct', 'isCorrect'));
    }
}
