# kuku-app  


小学2年生の娘のために「九九の練習アプリ」を製作中。
出題範囲を選んでタイムアタック！成績はスコアとして保存されます。

## 📌 現在開発中

このアプリは現在開発中です。  
進捗状況や設計内容は随時アップデートしていきます。

## ✅ 想定機能（予定）

- 出題範囲の選択（例：1の段、2の段など）
- タイムアタック形式のクイズ
- スコア記録・表示
- 過去の成績のランキング表示（予定）

## ⚙️ 技術スタック

- **Laravel**: 11.44.7
- **PHP**: 8.2.28
- **MySQL**: 8.0.26
- **Nginx**: 1.21.1
- **Docker / Docker Compose**: 最新
- **phpMyAdmin**: 利用（ポート: 8080）
- **フロントエンド**: Blade / JavaScript (Vanilla)

## 📁 ディレクトリ構成

kuku-app/
├── docker/
│   ├── mysql/
│   ├── nginx/
│   └── php/
├── docker-compose.yml
└── src/（Laravel 本体）

## 🚀 開発環境の立ち上げ

```bash
git clone https://github.com/yourname/kuku-app.git
cd kuku-app
cp src/.env.example src/.env
docker compose up -d --build
docker compose exec php composer install
docker compose exec php php artisan key:generate
docker compose exec php php artisan migrate