# Atte（アット）


## 背景・目的
* 人事評価に活用される勤怠管理システム構築の依頼があり実施
* （模擬案件①を通して実践に近い開発経験をつむ）


## アプリケーションURL
* 打刻ページ：http://localhost/
* 会員登録ページ：http://localhost/register
* ログインページ：http://localhost/login
* 日付別勤怠ページ：http://localhost/attendance
* phpMyAdmin：http://localhost:8080/


## Gitリポジトリ
* https://github.com/gh-sugiura/mock_project1.git


## アプリケーション機能
* 会員登録
* 会員のログインとログアウト
* 打刻による会員ごとの勤務時間管理（休憩時間も考慮可能）


## 使用技術
* laravel 8.83.8
* PHP 7.4.9
* MySQL 8.0.26
* nginx 1.21.1
* phpMyadmin
* diagrams.net


## ER図
<!-- ![ER図](er.drawio.png) -->


## 環境構築
**Dockerビルド**
1. `git clone git@github.com:coachtech-material/laravel-docker-template.git`
2. Gitリモートリポジトリ作成
3. GitリモートリポジトリとGitローカルリポジトリの紐付け
4. `docker-compose up -d --build`

**Laravel環境構築**
1. `docker-compose exec php bash`：PHPコンテナにログイン
2. `composer install`：composerのインストール
3. .env.exampleファイルから.envファイルを作成し、環境変数を設定
4. `php artisan key:generate`：アプリケーションキーの生成
5. `php artisan migrate`：マイグレーションの実行
6. `php artisan db:seed`：シーディングの実行 

&ensp;※`sudu chmod -R 777 *`：ファイルアクセス権限を付与