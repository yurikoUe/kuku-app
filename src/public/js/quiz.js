document.addEventListener('DOMContentLoaded', () => {
    const dan = parseInt(document.getElementById('quiz-container').dataset.dan);
    const totalQuestions = 9;
    const totalSteps = 10;
    let questionCount = 0;
    let correctCount = 0;

    let questions = [];
    for (let i = 1; i <= totalQuestions; i++) {
        questions.push({ a: dan, b: i });
    }
    questions = questions.sort(() => Math.random() - 0.5);

    const questionCard = document.getElementById('question-card');
    const answerCards = document.getElementById('answer-cards');
    const feedback = document.getElementById('feedback');
    const progressEl = document.getElementById('progress');
    const road = document.querySelector('.quiz__road');
    const roadWidth = road.clientWidth;
    const stepPx = roadWidth / totalSteps;
    const car = document.querySelector('.quiz__car');
    const resultEl = document.getElementById('result');

    // 音声ファイル
    const soundStart = new Audio('/sounds/start.mp3');
    const soundCorrect = new Audio('/sounds/correct1.mp3');
    const soundWrong = new Audio('/sounds/incorrect1.mp3');
    const soundFinishPerfect = new Audio('/sounds/finish_perfect.mp3');
    const soundFinish8 = new Audio('/sounds/finish_8.mp3');
    const soundFinish7 = new Audio('/sounds/finish_7.mp3');
    const soundFinishElse = new Audio('/sounds/finish_else.mp3');

    car.dataset.position = 0;
    car.style.transform = `translateX(0px)`;

    soundStart.play();

    function showQuestion() {
        if (questionCount >= totalQuestions) {
            showResult();
            return;
        }

        const { a, b } = questions[questionCount];
        const correct = a * b;

        questionCard.textContent = `${a} × ${b} = ?`;

        progressEl.textContent = `${questionCount + 1} / ${totalQuestions}`;
        feedback.textContent = '';

        // 不正解の選択肢を3つ作る
        const fakeAnswers = [];
        while (fakeAnswers.length < 3) {
            let offset = Math.floor(Math.random() * 5) + 1;
            let fake = Math.random() < 0.5 ? correct + offset : correct - offset;
            if (fake !== correct && fake > 0 && !fakeAnswers.includes(fake)) {
                fakeAnswers.push(fake);
            }
        }

        // 4つの選択肢をシャッフル
        const answers = [correct, ...fakeAnswers].sort(() => Math.random() - 0.5);

        // 既存の選択肢を消す
        answerCards.innerHTML = '';

        answers.forEach(answer => {
            const btn = document.createElement('button');
            btn.className = 'card answer';
            btn.textContent = answer;
            btn.disabled = false;
            btn.onclick = () => handleAnswer(btn, answer, correct);
            answerCards.appendChild(btn);
        });
    }

    function handleAnswer(btn, selected, correct) {
        const allButtons = answerCards.querySelectorAll('button');
        allButtons.forEach(b => b.disabled = true);
    
        if (selected === correct) {
            correctCount++;
            feedback.textContent = '正解！🎉';
            feedback.style.color = 'green';
            soundCorrect.play();
    
            // 車を進める
            let currentPos = parseInt(car.dataset.position) || 0;
            if (currentPos < totalSteps - 1) {
                currentPos++;
                car.dataset.position = currentPos;
                car.style.transform = `translateX(${stepPx * currentPos}px)`;
            }
        } else {
            feedback.textContent = `😭 こたえは ${correct} だよ！`;
            feedback.style.color = 'red';
            soundWrong.play();
            // ここで不正解でも次の問題へ進む
        }

        const dan = parseInt(document.getElementById('quiz-container').dataset.dan);
        localStorage.setItem('lastPlayedDan', dan);
    
        questionCount++;
        setTimeout(showQuestion, 1000);
    }
    

    function showResult() {
        // questionCard.textContent = '';
        questionCard.style.display = 'none';
        answerCards.innerHTML = '';
        feedback.style.display = 'none';
        progressEl.style.display = 'none';
    
        resultEl.textContent = `おつかれさま！${correctCount}問正解でした！`;
    
        let resultPage = '/result/low';
    
        if (correctCount === totalQuestions) {
            // 合格時に localStorage に記録
            const dan = parseInt(document.getElementById('quiz-container').dataset.dan);
            const mode = document.body.dataset.mode; // 事前に body タグに mode="quiz" などを付ける
    
            if (mode && dan) {
                localStorage.setItem(`dan_${dan}_${mode}_cleared`, 'true');
            }
            resultPage = '/result/perfect';
        } else if (correctCount === 8 || correctCount === 7) {
            resultPage = '/result/good';
        } else {
            soundFinishElse.play();
        }
    
        setTimeout(() => {
            location.href = resultPage;
        }, 2000);
    }

    showQuestion();
});
