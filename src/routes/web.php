<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return view('top');
});

Route::get('/{dan}/{mode}', function ($dan, $mode) {
    return view("quiz.{$mode}", ['dan' => $dan]);
})->where(['dan' => '[1-9]', 'mode' => 'practice|quiz']);

Route::get('/result/{type}', function ($type) {
    $score = request()->query('score');
    $dan = request()->query('dan');
    return view("result.$type", compact('score', 'dan'));
})->name('quiz.play');

Route::get('/time-attack', function () {
    return view('quiz.time-attack');
});

Route::get('/quiz', [QuizController::class, 'show']);
Route::post('/quiz', [QuizController::class, 'check']);
