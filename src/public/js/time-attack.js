document.addEventListener('DOMContentLoaded', () => {
    let score = 0;
    let timeLeft = 30;
    let timer;
    let currentLevel = parseInt(localStorage.getItem('ta_level')) || 1;
    let highScore = parseInt(localStorage.getItem('ta_highscore_level_' + currentLevel)) || 0;
    let currentQuestion = {};

    const questionEl = document.getElementById('question');
    const buttons = document.querySelectorAll('.answer-btn');
    const scoreEl = document.getElementById('score');
    const timerEl = document.getElementById('timer');
    const resultEl = document.getElementById('result');
    const nextBtn = document.getElementById('nextBtn');
    const startBtn = document.getElementById('startBtn');
    const resetBtn = document.getElementById('resetBtn');
    const quitBtn = document.getElementById('quitBtn');
    const gameArea = document.getElementById('gameArea');
    const levelEl = document.getElementById('level');
    const startScreen = document.getElementById('startScreen');

    // 効果音
    const startSound = new Audio('/sounds/start.mp3');
    const correctSound = new Audio('/sounds/correct1.mp3');
    const wrongSound = new Audio('/sounds/incorrect1.mp3');
    const endSound = new Audio('/sounds/end.mp3');
    const levelupSound = new Audio('/sounds/level-up.mp3');
    const nextSound = new Audio('/sounds/next.mp3');

    // レベルごとの背景色設定
    const levelColors = {
        1: '#E3F2FD', // 水色
        2: '#FCE4EC', // ピンク
        3: '#FFF9C4', // 黄色
        4: '#E8F5E9', // 緑
        5: '#FFF3E0', // オレンジ
        6: '#F3E5F5', // 紫
        7: '#ECEFF1', // グレー
        8: '#FFEBEE'  // 赤っぽい
    };

    function updateLevelDisplay() {
        levelEl.textContent = `レベル: ${currentLevel}`;
    }

    startBtn.addEventListener('click', () => {
        startScreen.style.display = 'none';
        gameArea.style.display = 'block';
        quitBtn.style.display = 'inline-block';
        startSound.play();
        updateLevelDisplay();
        startGame();
    });

    quitBtn.addEventListener('click', () => {
        if (confirm('ゲームをやめてスタート画面に戻りますか？')) {
            stopBGM();
            clearInterval(timer);
            gameArea.style.display = 'none';
            startScreen.style.display = 'block';
            quitBtn.style.display = 'none';
        }
    });

    resetBtn.addEventListener('click', () => {
        if (confirm('レベルを1にリセットしますか？')) {
            localStorage.setItem('ta_level', 1);
            currentLevel = 1;
            updateLevelDisplay();
            alert('レベルを1にリセットしました！');
        }
    });

    function generateQuestion() {
        const levelNum = Number(currentLevel);
        let maxStage;

        switch (levelNum) {
            case 1: maxStage = 2; break;
            case 2: maxStage = 3; break;
            case 3: maxStage = 4; break;
            case 4: maxStage = 5; break;
            case 5: maxStage = 6; break;
            case 6: maxStage = 7; break;
            case 7: maxStage = 8; break;
            case 8:
            default: maxStage = 9;
        }

        const stage = Math.floor(Math.random() * maxStage) + 1;
        const multiplier = Math.floor(Math.random() * 9) + 1;

        currentQuestion = {
            a: stage,
            b: multiplier,
            correctAnswer: stage * multiplier,
        };

        questionEl.textContent = `問題: ${stage} × ${multiplier} = ?`;

        const correct = currentQuestion.correctAnswer;
        const wrongAnswers = new Set();
        while (wrongAnswers.size < 3) {
            let diff = Math.floor(Math.random() * 5) + 1;
            let sign = Math.random() < 0.5 ? -1 : 1;
            let wrong = correct + sign * diff;
            if (wrong > 0 && wrong !== correct) {
                wrongAnswers.add(wrong);
            }
        }

        const allAnswers = [correct, ...wrongAnswers];
        allAnswers.sort(() => Math.random() - 0.5);

        buttons.forEach((btn, i) => {
            btn.textContent = allAnswers[i];
            btn.disabled = false;
        });
    }

    function playBGM() {
        const bgm = document.getElementById('bgm');
        bgm.volume = 0.1; // 音量調整
        bgm.play();
    }
    
    function stopBGM() {
        const bgm = document.getElementById('bgm');
        bgm.pause();
        bgm.currentTime = 0;
    }

    function startGame() {
        score = 0;
        timeLeft = 30;
        scoreEl.textContent = `スコア: ${score}`;
        timerEl.textContent = `のこり: ${timeLeft}s`;
        resultEl.textContent = '';
        nextBtn.style.display = 'none';

        document.getElementById('character').src = `/images/character_level${currentLevel}.png`;

        // レベルに応じて背景色を変更
        const bgColor = levelColors[currentLevel] || '#FFFFFF';
        document.body.style.backgroundColor = bgColor;

        updateLevelDisplay();

        playBGM();

        timer = setInterval(() => {
            timeLeft--;
            timerEl.textContent = `のこり: ${timeLeft}s`;

            if (timeLeft <= 0) {
                clearInterval(timer);
                endGame();
            }
        }, 1000);

        generateQuestion();
    }

    function updateScoreBar(correct, total) {
        const percent = (correct / total) * 100;
        document.getElementById('scoreBer').style.width = `${percent}%`;
    }

    function endGame() {
        stopBGM();

        const leveledUp = score >= 10 && currentLevel < 8;

        if (leveledUp) {
            levelupSound.play();
        } else {
            endSound.play();
        };

        resultEl.textContent = `おわり！スコア: ${score}`;

        if (score > highScore) {
            localStorage.setItem('ta_highscore_level_' + currentLevel, score);
            resultEl.textContent += '\n🎉最高スコアを更新しました！';
        }

        if (leveledUp) {
            currentLevel++;
            localStorage.setItem('ta_level', currentLevel);
            updateLevelDisplay();
            resultEl.textContent += `\n🎉レベル${currentLevel}へステージアップ！！`;
        }

        nextBtn.style.display = 'inline-block';
        buttons.forEach(btn => btn.disabled = true);
    }

    function checkAnswer(selectedBtn) {
        const selectedValue = parseInt(selectedBtn.textContent);

        if (selectedValue === currentQuestion.correctAnswer) {
            correctSound.play();
            score++;
            scoreEl.textContent = `スコア: ${score}`;
            generateQuestion();
        } else {
            wrongSound.play();
        }
    }

    buttons.forEach(btn => {
        btn.addEventListener('click', () => checkAnswer(btn));
    });

    nextBtn.addEventListener('click', () => {
        
        nextSound.play();
        startGame();
    });

    // 初期表示
    nextBtn.style.display = 'inline-block';
    quitBtn.style.display = 'none';
    updateLevelDisplay();
});
