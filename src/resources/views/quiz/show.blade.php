<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <title>ももちゃんの九九</title>
</head>
<body>
    <h1 class="quiz__title">九九チャレンジ</h1>
    <p class="quiz__question">問題: {{ $a }} × {{ $b }}</p>

    <div class="quiz__answers">
        <button id="leftBtn" class="quiz__button quiz__button--left">
            {{ $answers[0] }}
        </button>
        <button id="rightBtn" class="quiz__button quiz__button--right">
            {{ $answers[1] }}
        </button>
    </div>

    <p id="feedback" class="quiz__feedback"></p>


    <div class="quiz__road">
        <img src="{{ asset('images/car.png') }}" alt="車" class="quiz__car">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentQuestion = 1;
            let correctCount = 0;
            const totalQuestions = 5;

            const a = {{ $a }};
            const b = {{ $b }};
            let currentA = a;
            let currentB = b;
            let correctAnswer = currentA * currentB;

            const leftBtn = document.getElementById('leftBtn');
            const rightBtn = document.getElementById('rightBtn');
            const feedback = document.getElementById('feedback');

            function checkAnswer(userAnswer) {
                fetch('/api/check-answer', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        answer: userAnswer,
                        a: currentA,
                        b: currentB
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.correct) {
                        feedback.textContent = '正解！🎉';
                        feedback.style.color = 'green';
                        correctCount++;

                        const car = document.querySelector('.quiz__car');
                        let currentX = car.dataset.position ? parseInt(car.dataset.position) : 0;
                        currentX += 100;
                        car.style.transform = `translateX(${currentX}px)`;
                        car.dataset.position = currentX;
                    } else {
                        feedback.textContent = `不正解… 正解は ${data.correctAnswer} です`;
                        feedback.style.color = 'red';
                    }

                    setTimeout(() => {
                        if (currentQuestion < totalQuestions) {
                            currentQuestion++;
                            loadNextQuestion();
                        } else {
                            showResult();
                        }
                    }, 1000);
                })
                .catch(error => {
                    feedback.textContent = '通信エラーが発生しました';
                    feedback.style.color = 'orange';
                    console.error(error);
                });
            }

            function loadNextQuestion() {
                fetch('/api/quiz/next')
                    .then(response => response.json())
                    .then(data => {
                        currentA = data.a;
                        currentB = data.b;
                        correctAnswer = data.correct;

                        document.querySelector('.quiz__question').textContent = `問題: ${currentA} × ${currentB}`;
                        leftBtn.textContent = data.answers[0];
                        rightBtn.textContent = data.answers[1];
                        feedback.textContent = '';
                    });
            }

            function showResult() {
                const quizArea = document.querySelector('.quiz__answers');
                const question = document.querySelector('.quiz__question');
                const resultArea = document.createElement('div');
                resultArea.innerHTML = `
                    <p class="quiz__feedback">あなたの正解数は ${correctCount} / ${totalQuestions} 問でした！</p>
                    <button onclick="location.reload()">もう一度挑戦</button>
                `;
                quizArea.replaceWith(resultArea);
                question.textContent = '結果発表！';
            }

            leftBtn.addEventListener('click', () => checkAnswer(parseInt(leftBtn.textContent)));
            rightBtn.addEventListener('click', () => checkAnswer(parseInt(rightBtn.textContent)));
        });
    </script>




</body>
</html>
