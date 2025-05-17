<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $dan }}の段の練習（カルタ形式）</title>
    
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 2rem;
            background: #f0f8ff;
        }
        #quiz-container {
            max-width: 600px;
            margin: 0 auto;
        }
        #question-card {
            border: 3px solid #0077cc;
            border-radius: 20px;
            background-color: #d0eaff;
            font-size: 5rem;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            user-select: none;
            box-shadow: 3px 3px 8px rgba(0,0,0,0.15);
        }
        #answer-cards {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            /* flex-wrap: wrap; */
        }
        .card.answer {
            border: 3px solid #0099ff;
            border-radius: 16px;
            background-color: #e6f2ff;
            font-size: 3rem;
            padding: 2rem 2.5rem;
            cursor: pointer;
            user-select: none;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.1);
            transition: background-color 0.3s, transform 0.2s;
            min-width: 120px;
        }
        .card.answer:hover {
            background-color: #b3daff;
            transform: translateY(-5px);
        }
        #feedback {
            margin-top: 1.5rem;
            font-size: 2rem;
            height: 2.5rem;
            user-select: none;
        }
        #progress {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        #result {
            font-size: 2rem;
            margin-top: 3rem;
            color: #006600;
            font-weight: bold;
            user-select: none;
        }
        /* 車と道はそのまま使う */
        .quiz__road {
            position: fixed;
            bottom: 10%;
            left: 0;
            width: 100%;
            height: 40px;
            background-color: #eee;
            border: 2px dashed #aaa;
            z-index: 10;
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
            background-image: url('/images/flag.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            position: absolute;
            right: 50px;
            bottom: 40px;
            transform: translate(50%, 50%);
        }
    </style>
</head>
<body data-mode="quiz">
    <div id="quiz-container" data-dan="{{ $dan }}">
        <h1>{{ $dan }}の段・カルタクイズモード</h1>
        <div id="progress"></div>
        <div id="question-card"></div>
        <div id="answer-cards"></div>
        <div id="feedback"></div>

        <div class="quiz__road">
            <div class="quiz__car"></div>
            <div class="quiz__goal"></div>
        </div>
        <div id="result"></div>
    </div>

    <script src="{{ asset('js/quiz.js') }}"></script>
</body>
</html>
