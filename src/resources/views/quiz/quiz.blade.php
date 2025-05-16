<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $dan }}の段の練習</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 2rem; }
        .quiz-box { font-size: 4rem; margin: 2rem; }
        .question { font-size: 3rem;}
        .next-btn { padding: 3rem 3rem; font-size: 2rem; }
        .complete { color: green; font-size: 1.5rem; margin-top: 1rem; }
        .quiz__road {
            position: fixed; /* ← ここを fixed に */
            bottom: 30%;     /* ← 画面下から20pxの位置に固定 */
            left: 0;
            width: 100%;
            height: 40px;
            background-color: #eee;
            border: 2px dashed #aaa;
            z-index: 10; /* 他の要素より前に出す */
        }

        .quiz__car {
            width: 70px;
            height: 70px;
            bottom: 30px;
            background-image: url('/images/car.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
            transition: transform 0.3s;
        }
        .quiz__goal {
            width: 80px;
            height: 80px;
            background-image: url('/images/flag.png'); /* ゴール旗の画像パス */
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            position: absolute;
            right: 50px;
            bottom: 40px;
            transform: translate(50%, 50%); /* 少し右下にオフセット */
        }

    </style>
</head>
<body>
<div id="quiz-container" class="quiz" data-dan="{{ $dan }}">
    <h1>{{ $dan }}の段・クイズモード</h1>

    <div id="quiz-container" data-dan="3">
        <div id="progress" style="font-weight: bold; margin-bottom: 10px;"></div>
        <div id="question" class="question"></div>
        <button id="leftBtn" class="quiz-box"></button>
        <button id="rightBtn" class="quiz-box"></button>
        <div id="feedback"></div>
        <div class="quiz__road">
            <div class="quiz__car"></div>
            <div class="quiz__goal"></div>
        </div>
        <div id="result"></div>
    </div>
</div>

<script src="{{ asset('js/quiz.js') }}"></script>
</body>
</html>
