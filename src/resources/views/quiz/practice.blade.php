<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $dan }}の段の練習</title>
    <body data-mode="practice">
    <style>
        body { font-family: sans-serif; text-align: center; padding: 2rem; }
        .quiz-box { font-size: 2rem; margin: 2rem; }
        .next-btn { padding: 1rem 2rem; font-size: 1.2rem; }
        .complete { color: green; font-size: 1.5rem; margin-top: 1rem; }
    </style>
</head>
<body>
    <h1>{{ $dan }}の段の練習</h1>
    <p>声に出して言ってみよう！</p>
    <div id="quiz" class="quiz-box"></div>
    <button id="nextBtn" class="next-btn">おぼえた！</button>
    <div id="completeMsg" class="complete" style="display:none;">おぼえたね！💮</div>

    <script>
        const dan = {{ $dan }};
        const quizEl = document.getElementById('quiz');
        const nextBtn = document.getElementById('nextBtn');
        const completeMsg = document.getElementById('completeMsg');

         // 音声オブジェクト
        const startSound = new Audio('/sounds/start.mp3');
        const nextSound = new Audio('/sounds/next.mp3');
        const completeSound = new Audio('/sounds/complete.mp3');


        let step = 1;
        const total = 9;

        function showQuiz() {
            if (step <= total) {
                quizEl.textContent = `${dan} × ${step} = ${dan * step}`;
                nextSound.play(); // 音を鳴らす（読み上げの代わり）
            } else {
                quizEl.textContent = '';
                nextBtn.style.display = 'none';
                completeMsg.style.display = 'block';
                completeSound.play();

                // 合格フラグ保存
                localStorage.setItem('dan_' + dan + '_cleared', 'true');
            }
        }

        nextBtn.addEventListener('click', () => {
            step++;
            showQuiz();
        });

        // 最初の表示
        startSound.play(); 
        showQuiz();
    </script>
</body>
</html>
