<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>パーフェクト！</title>
  <style>
    @keyframes float {
      0%   { transform: translateY(0)    scale(1); }
      50%  { transform: translateY(-20px) scale(1.1); }
      100% { transform: translateY(0)    scale(1); }
    }
    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
      font-family: sans-serif;
      background: url('/images/perfect-bg.jpg') center/cover no-repeat;
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
      animation: float 2s ease-in-out infinite;
    }
    .score {
      font-size: 1.5rem;
      margin-bottom: 2rem;
    }
    .medal {
      width: 200px;
      animation: float 3s ease-in-out infinite;
    }
    .buttons button {
      margin: 0.5rem;
      padding: 0.8rem 1.5rem;
      font-size: 1.2rem;
      border: none;
      border-radius: 2rem;
      background: #ffd54f;
      color: #333;
      cursor: pointer;
      transition: transform .2s;
    }
    .buttons button:hover {
      transform: scale(1.1);
    }
    /* 簡易・無限に降るキラキラ */
    .party {
      position: absolute; top: -50px; left: 50%;
      width: 20px; height: 20px;
      background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(255,223,0,0.8) 80%);
      border-radius: 50%;
      animation: fall linear infinite;
    }
    @keyframes fall {
      to { transform: translateY(120vh) translateX(-50vw); opacity: 0; }
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="container">
    <h1>🎉 パーフェクト！🎉</h1>
    <p class="score">{{ $score }}問中{{ $score }}問正解！</p>
    <img class="medal" src="/images/perfect.png" alt="金メダル">
    <div class="buttons">
        <button onclick="location.href='{{ url(request()->query('dan') . "/quiz") }}'">もういちど</button>
        <button onclick="location.href='/'">おわる</button>
    </div>
  </div>
  <!-- BGM -->
  <audio id="bgm" src="/sounds/perfect.mp3" autoplay loop></audio>

  <!-- 簡易パーティーパーティクル -->
  <script>
    for(let i=0; i<30; i++) {
      const p = document.createElement('div');
      p.className = 'party';
      p.style.left = Math.random()*100 + 'vw';
      p.style.animationDuration = 2+Math.random()*3+'s';
      p.style.width = p.style.height = (10+Math.random()*20)+'px';
      document.body.appendChild(p);
    }
  </script>
</body>
</html>
