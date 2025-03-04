# アプリケーション名
    Task-manager バックエンド (TodoアプリのバックエンドAPI)
<img width="650" src="https://github.com/user-attachments/assets/53445c5a-4ed5-415c-9bd0-a295ac0adbb5">




## 概要説明
- Task-managerアプリのフロントエンドにAPIを提供する




## 作成目的
- Task-manager(フロントエンド)と連携し、ユーザー情報・Todoリストを管理するため.

- フロントエンドからのリクエストを受け取り、データベース（MySQL）とのやり取りを行う。




## バックエンドAPIの役割
- Task-manager のバックエンド API として、データ管理を担う
- ユーザー認証（Laravel Fortify を使用）
- Todoデータの管理（作成・取得・更新・削除）
- データベース（MySQL）との連携（Eloquent ORM を利用）




## アプリケーションURL

### ローカル環境
`http://localhost/8000/`




## 機能一覧

#### ユーザー管理 (Laravel Fortify)
- ユーザーの登録（`POST /api/register`）
- ユーザーの認証（`POST /api/login`）
- ユーザーのログアウト（`POST /api/logout`）
- ユーザー情報の取得（`GET /api/user`）
- ユーザー情報の更新（`PUT /api/user`）

#### 投稿管理
- Todoの取得（`GET /api/tasks`）
- Todoの作成（`POST /api/tasks`）
- Todoの編集（`PUT /api/tasks/{taskId}`）
- Todoの削除（`DELETE /api/tasks/{taskId}`）

#### その他
- ユーザー別の各データ取得
- フォームリクエストによるバリデーション




## 詳細内容
- テスト用ユーザーはSeedで追加可能。
  ユーザー名:test1  email: test1@example.com    password: 11111111

- Seedで作成されたユーザーに対してテスト用の投稿が追加される。

- Todoの作成・取得・更新・削除
    個別のTodo管理画面は認証済みのユーザーのみアクセス可能
    Todoの追加・取得・更新・削除にはユーザー認証が必要





## 使用技術
- Docker 27.3.1
- php 8.3.13
- Laravel 8.83.29
- Composer 2.8.4
- nginx 1.21.1
- Mysql 8.0.37
- phpMyAdmin 5.2.1





## テーブル設計
<img width="650" src="https://github.com/user-attachments/assets/f017f6b7-3575-4df0-86e6-51dfe383c4b9">




## ER図
<img width="650" src="https://github.com/user-attachments/assets/e313a860-bb03-42e9-81db-e0024f5cd081">




## dockerビルド
    1 git clone リンク  https://github.com/Okazuma/share-app-backend.git

    2 docker compose up -d --build

    ※ MysqlはOSによって起動しない場合があるので、それぞれのPCに合わせてdocker-compose.ymlを編集してください。




## Laravelの環境構築
- phpコンテナにログイン        $docker compose exec php bash

- パッケージのインストール      $composer-install

- .envファイルの作成          cp .env.example .env

- アプリケーションキーの生成    $php artisan key:generate

- マイグレーション            $php artisan migrate

- シーディング               $php artisan db:seed




## CORS 設定について
- フロントエンド（例: `http://localhost:8081`）から API にアクセスできるようにするため、'config/cors.php'で以下の設定を追加しています。
'allowed_origins' => ['http://localhost:8081']