# Atte
勤怠管理アプリ

## 作成した目的
従業員の勤怠管理

## アプリケーションURL
デプロイしていないためURLはありません。

## 機能一覧
- ユーザー登録
- ユーザーログイン
- ログインユーザー出勤
- ログインユーザー休憩開始
- ログインユーザー休憩終了
- ログインユーザー退勤
- 日付別全ユーザー勤怠履歴表示（ログイン時のみ）
- ユーザー別月ごと勤怠履歴表示（ログイン時のみ）

## 実行環境
言語：PHP 8.3.9  
フレームワーク：Laravel 8.83.27  
データベース：MySQL

## テーブル設計
https://github.com/klaboworks/Atte/issues/31#issue-2556283094

## ER図
https://github.com/klaboworks/Atte/issues/30#issue-2556243700

# 環境構築
### gitをクローン
 - `git clone git@github.com:klaboworks/Atte.git`
### PHPコンテナを生成して起動/ログイン
 - `docker-compose up -d --build`
 - `docker-compose exec php bash`
### パッケージをインストール
 - `composer install`
### キーを作成
 - `php artisan key:generate`
### .envファイルを作成
 - `cp .env.example .env`
 - `exit`
### .envファイのル11~16行目を下記に変更
    DB_CONNECTION=mysql  
    DB_HOST=mysql  
    DB_PORT=3306  
    DB_DATABASE=laravel_db  
    DB_USERNAME=laravel_user  
    DB_PASSWORD=laravel_pass  