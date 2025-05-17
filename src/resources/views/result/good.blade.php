<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>よくできました！</title>
  <style>
    html, body {
      height: 100%;
    }
    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
      font-family: sans-serif;
      background: url('/images/good-bg.jpg') center/cover no-repeat;
      color: #fff;
      text-align: center;
    }
    .overlay {
      position: absolute; top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.4);
    }
    .container {
      position: relative;
      z-index: 10;
      padding: 4rem 2rem;
    }
    h1 {
      font-size: 3rem;
      margin-bottom: 1rem;
      animation: bounce 1.5s infinite;
    }
    .score {
      font-size: 1.5rem;
      margin-bottom: 2rem;
    }
    .medal {
      width: 150px;
    }
    .buttons button {
      margin: 0.5rem;
      padding: 0.8rem 1.5rem;
      font-size: 1.2rem;
      border: none;
      border-radius: 2rem;
      background: #4fc3f7;
      color: #fff;
      cursor: pointer;
      transition: transform .2s;
    }
    .buttons button:hover {
      transform: scale(1.1);
    }
    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="container">
    <h1>✨ よくできました！ ✨</h1>
    <p class="score">{{ $score }}問正解！</p>
    <img class="medal" src="/images/good.png" alt="銀メダル">
    <div class="buttons">
      <button id="retry-button">もういちど</button>
      <button onclick="location.href='/'">おわる</button>
    </div>
  </div>
  <audio id="bgm" src="/sounds/good.ogg" autoplay loop></audio>
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
