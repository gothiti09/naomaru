# 環境構築

## 前提
* Dockerがインストールされていること

## git clone
以下を実行
`git clone https://github.com/{github-account}/{project-name}.git`

## ライブラリインストール
git cloneだけだとsailコマンドも使えない状態なので、docker経由でcomposer installする
`cd {project-name}`してから以下を実行
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```
参考:https://laravel.com/docs/8.x/sail#installing-composer-dependencies-for-existing-projects

## 環境変数を設定する
以下を実行
`cp .env.example .env`

## Docker起動
以下を実行
`sail up -d` でDocker起動
別のプロセスで利用しているとエラーになるので、事前に別プロセスを就床するかポートを変える

## ライブラリインストール
`./vendor/bin/sail composer install`

※都度`./vendor/bin/sail`を打たずに`sail`とするにはalias登録しておくと便利
```
vi ~/.bash_profile
alias sail="./vendor/bin/sail"
source ~/.bash_profile
```

## データ準備
`./vendor/bin/sail artisan migrate:fresh --seed`でデータ整備

## フロントインストール＆ビルド
`./vendor/bin/sail npm install`でフロントライブラリをインストール
`./vendor/bin/sail npm run dev`でフロントコードをビルド

# 接続確認
## Web
http://localhost/

## DB
DB_HOST:127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

## メール
http://localhost:8025/

# リリース手順
## 前提
* heroku CLIがインストールされていること
https://devcenter.heroku.com/ja/articles/heroku-cli#download-and-install

## heroku開発環境
* developブランチにマージすると自動でデプロイされる
* データベースの定義変更は `heroku run php artisan migrate -a {project-name}` を実行する（migrateだけなら追加したマイグレーションファイルの実行のみ。環境指定が心配な場合は `heroku run ls -a {project-name}` を実行してみるのもあり。）

## heroku本番環境
* mainブランチにマージすると自動でデプロイされる
* データベースの定義変更は `heroku run php artisan migrate -a {project-name}` を実行する
* 本番環境のみ「Do you really wish to run this command?」と表示されるので「yes」と入力してenter


# 開発環境
以下にアクセス。（なおHeorku無料プランの場合、1間操作していないとインスタンスが停止するので初回操作時に30秒程度時間がかかる。）
https://{project-name}.herokuapp.com/
