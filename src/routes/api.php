<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizApiController;

Route::post('/check-answer', [QuizApiController::class, 'checkAnswer']);
Route::get('/quiz/next', [QuizApiController::class, 'nextQuestion']);
