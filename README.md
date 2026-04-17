# アプリケーション名

laravel_practice

## 作成した目的

Laravel を用いた Web アプリケーション開発の練習。
飲食店予約サービスを想定したアプリケーションの作成。

CRM 連携の学習を目的として **Zoho CRM API を利用した外部サービス連携** の実装。

予約作成時に Zoho CRM へ商談(Deal)を作成し、予約確認書 PDF を自動生成して Zoho の商談に添付する機能を実装

## URL

- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
- MailHog：http://localhost:8026/

## 他のレポジトリ

https://github.com/BRina1016/rese.git

## 機能一覧

・会員登録機能
・ログイン・ログアウト機能
・ユーザー情報取得（予約・お気に入り一覧取得）
・飲食店一覧取得
・飲食店詳細取得
・飲食店お気に入り追加・削除機能
・飲食店予約情報追加・削除・変更機能
・飲食店評価機能
・エリア・ジャンル・店名検索機能
・メール認証機能 (途中)
・Zoho CRM API 連携
・Zoho Contact 自動作成
・Zoho Deal 自動作成
・予約変更時の Zoho 商談更新
・予約削除時の Zoho 商談削除
・予約確認書 PDF 生成
・Zoho 商談への PDF 自動添付

## 使用技術(実行環境)

- PHP 7.4.9
- Laravel 8.83.27
- MySQL
- Docker / Docker Compose
- Zoho CRM API
- DomPDF（PDF 生成）
- MailHog（メールテスト）

## 外部サービス連携

本アプリでは Zoho CRM API を利用した CRM 連携機能を実装しています。

### 実装内容

・予約作成時に Zoho CRM の Contact を取得または作成
・予約情報を Zoho CRM の Deal として登録
・予約変更時に Zoho 商談を更新
・予約削除時に Zoho 商談を削除
・予約確認書 PDF を生成
・生成した PDF を Zoho 商談に自動添付

### 処理フロー

・ユーザーが予約を作成
・予約情報をデータベースへ保存
・Zoho CRM API を使用して Contact を取得または作成
・Zoho CRM の Deal を作成
・予約確認書 PDF を生成
・生成した PDF を Zoho CRM の Deal へ添付

## テーブル仕様書

https://docs.google.com/spreadsheets/d/18JZ3SIUtBdMqRYJztDO2PIVWwcRkhxB6j3xj4C4R1-M/edit?gid=0#gid=0

## 基本設計書

https://docs.google.com/spreadsheets/d/18JZ3SIUtBdMqRYJztDO2PIVWwcRkhxB6j3xj4C4R1-M/edit?gid=663308514#gid=663308514

## ER 図

https://docs.google.com/spreadsheets/d/18JZ3SIUtBdMqRYJztDO2PIVWwcRkhxB6j3xj4C4R1-M/edit?gid=982964951#gid=982964951

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
