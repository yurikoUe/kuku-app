<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タイムアタックチャレンジ</title>
    <link rel="stylesheet" href="{{ asset('css/time-attack.css') }}">
</head>
<body>
    <h1>タイムアタックチャレンジ</h1>

    

    <!-- スタート画面 -->
    <div id="startScreen">
        <button id="startBtn">スタート</button>
        <button id="resetBtn">レベルをリセット</button>
        <span id="level">レベル: </span>
    </div>

    
    

    <!-- ゲーム画面 -->
    <div id="gameArea" style="display:none;">
        <div class="game-info">
            <div id="score" class="game-info_score"></div>
            <div id="timer" class="game-info_timer"></div>
        </div>
        <div id="question"></div>
        <div>
            <button class="answer-btn"></button>
            <button class="answer-btn"></button>
            <button class="answer-btn"></button>
            <button class="answer-btn"></button>
        </div>
        
        
        <div id="result"></div>
        <button id="nextBtn">次のチャレンジ</button>
        <button id="quitBtn">やめる</button> <!-- 追加 -->
        <img id="character" src="" alt="キャラクター">
</div>

    {{-- 音声 --}}
    <audio id="start-sound" src="{{ asset('sounds/start.mp3') }}"></audio>
    <audio id="next-sound" src="{{ asset('sounds/next.mp3') }}"></audio>
    <audio id="end-sound" src="{{ asset('sounds/end.mp3') }}"></audio>
    <audio id="bgm" src="{{ asset('sounds/time-attack-bgm.mp3') }}" loop></audio>


    {{-- スクリプト --}}
    <script src="{{ asset('js/time-attack.js') }}"></script>
</body>

</html>
