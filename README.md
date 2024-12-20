# アプリケーション名

Rese（リーズ）

## 作成した目的

自社で予約サービス

## URL

- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
- MailHog：http://localhost:8026/

## 他のレポジトリ

https://github.com/BRina1016/rese.git

## 機能一覧

飲食店予約サービス
・会員登録機能
・ログイン・ログアウト機能
・ユーザー情報取得（予約・お気に入り一覧取得）
・飲食店一覧取得
・飲食店詳細取得
・飲食店お気に入り追加・削除機能
・飲食店予約情報追加・削除・変更機能
・飲食店評価機能
・エリア・ジャンル・店名検索機能
・メール認証機能

## 使用技術(実行環境)

- PHP 7.4.9
- Laravel 8.83.27
- mysql 15.1

## テーブル設計

https://docs.google.com/spreadsheets/d/150wy28z3z4K247SAE0BzzOmoayoVqa7nLqdKE1wCzbA/edit?gid=1635115377#gid=1635115377

## ER 図

https://docs.google.com/spreadsheets/d/150wy28z3z4K247SAE0BzzOmoayoVqa7nLqdKE1wCzbA/edit?gid=320603785#gid=320603785

**Docker ビルド**

1. `git clone https://github.com/BRina1016/rese.git`
2. DockerDesktop アプリを立ち上げる
3. `docker-compose up -d --build`

**Laravel 環境構築**

1. `docker-compose exec php bash`
2. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.env ファイルを作成
   cp .env.example .env

3. .env に以下を追加
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_pass

4. `composer install`

5. アプリケーションキーの作成
   php artisan key:generate

6. マイグレーションの実行
   php artisan migrate

7. シーディングの実行
   php artisan db:seed
