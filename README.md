# SI Laravel Template
## これは何か
SI事業部でLaravelを使ったバックエンド開発の雛形となるテンプレートです。
swagger自動生成や認証基盤がすでに実装済みです。

ディレクトリ構造もLaravelの基本的なものに加えていくつか追加してあります。

## 事前準備

サーバー証明書を発行するために[mkcert](https://formulae.brew.sh/formula/mkcert)を導入します。
※フロントがhttps対応しないとLIFFが使えず、フロントに合わせないとcookie周りで不都合が出るため

- Mac の場合

  1. [Homebrew](https://brew.sh/ja/)をインストールしていない場合はインストールしてください。
  2. mkcert をインストール

  ```bash
  brew install mkcert
  mkcert -install
  ```

- Windows の場合
  1. PowerShell を起動します。
  2. mkcert をインストール
  ```bash
  choco install mkcert
  mkcert -install
  ```

## 初回起動方法

```bash
# プロジェクトルートに移動して
. ./init.sh

# もし起動に失敗するようであれば続けて
docker compose up
```

## ディレクトリ構成
※ Laravel基本のものは記載してません。
```
.docker // ローカル環境用のDockerに用いるファイル群。PHPやnginxの設定はで変更
.github // ワークフローやプルリクのテンプレートなど。
src
 ┣ app
 ┃ ┣ Domain //アプリの核となるオブジェクト(Entity/ValueObject)
 ┃ ┃
 ┃ ┣ Http
 ┃ ┃ ┣ Request     // リクエストで渡される値のバリデーションを行う
 ┃ ┃ ┣ Responses   // レスポンスに必要なパラメータを保持/生成する
 ┃ ┃ ┗ Services    // ビジネスロジック
 ┃ ┃
 ┃ ┗ Repositories  // 外部(DB, API ...etc)とのやりとりを行う
 ┃
 ┗ その他はLaravelに準拠
.env.example  // docker用の環境変数のサンプル。必要な値は.envにコピーして変更
docker-compose.yml  // ローカル環境用のdocker compose設定ファイル。minioやmailpit
init.sh  // 初回構築時のコマンド集。動作確認してませんので不具合あればプルリクください。
```

## swaggerの記載場所
```
Controller    エンドポイント情報を記述
Domain        各種オブジェクト(schema)を記述
Request       リクエスト値を記述
Responses     レスポンス値を記述
```

## 環境構築手順
上記から順に行ってください
```
git clone クローン用リンク
```

```
docker compose build --no-cache
```

```
source init.sh
```

## コマンド集
立ち上がっているコンテナの確認
```
docker compose ps
```
viteの起動
```
docker compose exec app npm run dev
```
コンテナに改装移動
```
docker exec -it コンテナ名 bash
```

## インストールパッケージ
- [breezejp](https://github.com/askdkc/breezejp) : breeze日本用パッケージ