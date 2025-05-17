<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>つぎ がんばろう！</title>
  <style>
    html, body {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
      font-family: sans-serif;
      background: url('/images/low-bg.jpg') center/cover no-repeat;
      color: #fff;
      text-align: center;
      animation: fadeIn 2s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to   { opacity: 1; }
    }

    .overlay {
      position: absolute; top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
    }

    .container {
      position: relative;
      z-index: 10;
      padding: 4rem 2rem;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    .score {
      font-size: 1.3rem;
      margin-bottom: 2rem;
    }

    .medal {
      width: 120px;
      opacity: 0.8;
      animation: float 2s ease-in-out infinite;
      position: relative;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    .tear {
        position: absolute;
        width: 12px;
        height: 16px;
        background: rgba(173, 216, 230, 0.85);
        border-radius: 50%;
        animation: drop 1.5s infinite;
        top: 140px;
        z-index: 5;
        opacity: 0;
    }

    @keyframes drop {
        0% {
            opacity: 0;
            transform: translateY(0);
        }
        20% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: translateY(60px);
        }
    }


    .buttons button {
        margin: 0.5rem;
        padding: 0.8rem 1.5rem;
        font-size: 1.2rem;
        border: none;
        border-radius: 2rem;
        background: #ff8a65;
        color: #fff;
        cursor: pointer;
        transition: transform .2s;
    }

    .buttons button:hover {
      transform: scale(1.1);
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="container">
    <h1>🌱 つぎ がんばろう！</h1>
    <p class="score">{{ $score }}問正解だったよ。</p>

    <!-- パンダ画像 -->
    <div style="position: relative; display: inline-block;">
        <img class="medal" src="/images/low.png" alt="泣くパンダ">

        <!-- 涙1 -->
        <div class="tear" style="left: 45%; animation-delay: 0s;"></div>
        <!-- 涙2 -->
        <div class="tear" style="left: 55%; animation-delay: 0.3s;"></div>
        <!-- 涙3 -->
        <div class="tear" style="left: 47%; animation-delay: 0.6s;"></div>
        <!-- 涙4 -->
        <div class="tear" style="left: 53%; animation-delay: 0.9s;"></div>
    </div>


    <div class="buttons">
      <button id="retry-button">もういちど</button>
      <button type="button" onclick="location.href='/'">おわる</button>
    </div>
  </div>
  <audio id="bgm" src="/sounds/low.mp3" autoplay loop></audio>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const retryBtn = document.getElementById('retry-button');
      retryBtn.addEventListener('click', () => {
          const dan = localStorage.getItem('lastPlayedDan');
          if (dan) {
              location.href = `/${dan}/quiz`;
          } else {
              alert('前回の段が見つかりませんでした。');
          }
        });
    });
  </script>
</body>
</html>
