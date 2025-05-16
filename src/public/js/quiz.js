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

    const questionEl = document.getElementById('question');
    const leftBtn = document.getElementById('leftBtn');
    const rightBtn = document.getElementById('rightBtn');
    const feedback = document.getElementById('feedback');
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

    // 初期位置は0
    car.dataset.position = 0;
    car.style.transform = `translateX(0px)`;

    // **開始音を再生**
    soundStart.play();

    function showQuestion() {
        const { a, b } = questions[questionCount];
        const correct = a * b;

        questionEl.textContent = `${a} × ${b} = ?`;

        //進捗表示を更新
        const progressEl = document.getElementById('progress');
        progressEl.textContent = `${questionCount + 1} / ${totalQuestions}`;

        let fake;
        do {
            const offset = Math.floor(Math.random() * 5 + 1);
            fake = Math.random() < 0.5 ? correct + offset : correct - offset;
        } while (fake === correct || fake < 0);

        const answers = [correct, fake].sort(() => Math.random() - 0.5);

        leftBtn.textContent = answers[0];
        rightBtn.textContent = answers[1];

        leftBtn.disabled = false;
        rightBtn.disabled = false;

        leftBtn.onclick = () => handleAnswer(answers[0], correct);
        rightBtn.onclick = () => handleAnswer(answers[1], correct);
    }

    function handleAnswer(answer, correctAnswer) {
        leftBtn.disabled = true;
        rightBtn.disabled = true;

        const isCorrect = answer === correctAnswer;

        if (isCorrect) {
            correctCount++;
            feedback.textContent = '正解！🎉';
            feedback.style.color = 'green';
            soundCorrect.play();

            let currentPos = parseInt(car.dataset.position) || 0;
            if (currentPos < totalSteps - 1) {
                currentPos++;
                car.dataset.position = currentPos;
                car.style.transform = `translateX(${stepPx * currentPos}px)`;
            }
        } else {
            feedback.textContent = `😭😭😭こたえは ${correctAnswer} だよ`;
            feedback.style.color = 'red';
            soundWrong.play();
        }

        questionCount++;
        if (questionCount < totalQuestions) {
            setTimeout(() => {
                feedback.textContent = '';
                showQuestion();
            }, 1000);
        } else {
            setTimeout(showResult, 1000);
        }
    }

    function showResult() {
        questionEl.textContent = '';
        leftBtn.style.display = 'none';
        rightBtn.style.display = 'none';
        feedback.style.display = 'none';
    
        resultEl.textContent = `おつかれさま！${correctCount}問正解でした！`;
    
        let resultPage = '/result/low';
    
        if (correctCount === totalQuestions) {
            resultPage = '/result/perfect';
        } else if (correctCount === 8 || correctCount === 7) {
            resultPage = '/result/good';
        }
    
        // 効果音なしで即遷移
        window.location.href = `${resultPage}?score=${correctCount}&dan=${dan}`;
    }
    

    showQuestion();
});
