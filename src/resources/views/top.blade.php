<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    <title>九九チャレンジ</title>
</head>
<body>
    <div class="header">
        <h1>九九チャレンジ</h1>
        <p>段を選んでモードを選ぼう！</p>
    </div>

    <div class="dan-buttons">
        @for ($i = 1; $i <= 9; $i++)
            <div class="dan-card" data-dan="{{ $i }}">
                <div>{{ $i }}の段</div>
                <div class="modes">
                    <a href="/{{ $i }}/practice">練習</a> |
                    <a href="/{{ $i }}/quiz">クイズ</a>
                </div>
                <div id="badge-{{ $i }}"></div>
            </div>
        @endfor
    </div>

    <div style="margin-top: 3rem;">
        <a href="/time-attack">▶ タイムアタックチャレンジ</a>
    </div>

    <script>
        // 合格済み段に「💮」を表示
        document.addEventListener('DOMContentLoaded', () => {
            for (let i = 1; i <= 9; i++) {
                if (localStorage.getItem('dan_' + i + '_cleared') === 'true') {
                    document.getElementById('badge-' + i).textContent = '💮 合格！';
                    document.getElementById('badge-' + i).classList.add('cleared');
                }
            }
        });
    </script>
</body>
</body>
</html>
