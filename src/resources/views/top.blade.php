<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    <title>九九チャレンジ</title>
    <link href="https://fonts.googleapis.com/css2?family=Rampart+One&family=Yomogi&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&family=Yomogi&display=swap" rel="stylesheet">


</head>
<body>
    <div class="header">
        <h1>⭐️ 九九チャレンジ ⭐️</h1>
        <p>だんとモードをえらぼう！</p>
    </div>

    <div class="dan-buttons">
        @for ($i = 1; $i <= 9; $i++)
            <div class="dan-card" data-dan="{{ $i }}" onclick="playClickSound()">
                <div>{{ $i }}のだん</div>
                <div class="modes">
                    <div class="mode-item">
                        <a href="/{{ $i }}/practice">れんしゅう</a>
                        <span id="badge-{{ $i }}-practice" class="badge"></span>
                    </div>
                    <div class="mode-item">
                        <a href="/{{ $i }}/quiz">クイズ</a>
                        <span id="badge-{{ $i }}-quiz" class="badge"></span>
                    </div>
                </div>
                <div id="badge-{{ $i }}"></div>
            </div>
        @endfor
    </div>

    <a href="/time-attack" class="time-attack" onclick="playClickSound()">▶ タイムアタックチャレンジ</a>

    <!-- BGM -->
    <audio id="bgm" src="{{ asset('sounds/bgm.mp3') }}" autoplay loop></audio>
    <audio id="clickSound" src="{{ asset('sounds/click.mp3') }}"></audio>
    <button onclick="toggleBGM()" style="position: fixed; top: 1rem; right: 1rem;">🔊 / 🔇</button>

    <!-- Balloons -->
    <script>
        for (let i = 0; i < 15; i++) {
            const b = document.createElement('div');
            b.className = 'balloon';
            b.style.left = Math.random() * 100 + 'vw';
            b.style.animationDelay = (Math.random() * 10) + 's';
            b.style.backgroundColor = `hsla(${Math.random() * 360}, 80%, 75%, 0.7)`;
            document.body.appendChild(b);
        }

        document.addEventListener('DOMContentLoaded', () => {
            for (let i = 1; i <= 9; i++) {
                if (localStorage.getItem('dan_' + i + '_practice_cleared') === 'true') {
                    document.getElementById(`badge-${i}-practice`).textContent = '💮';
                }
                if (localStorage.getItem('dan_' + i + '_quiz_cleared') === 'true') {
                    document.getElementById(`badge-${i}-quiz`).textContent = '💮';
                }
            }
        });

        function toggleBGM() {
            const bgm = document.getElementById('bgm');
            bgm.muted = !bgm.muted;
        }

        function playClickSound() {
            document.getElementById('clickSound').play();
        }
    </script>
</body>
</html>