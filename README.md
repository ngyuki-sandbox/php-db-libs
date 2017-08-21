# php-db-libs

## doctrine/dbal

- https://github.com/doctrine/dbal
- insert/update で存在しない列名がデータに含まれていても無視されない
- update/delete の条件句は一致のみ
- transactional はありがちだけど有用
- fetch 系はプレーンな配列を返す
    - よくある PDO ライクな fetch とかは定義されている
- クエリビルダが使いにくい？
    - SQL をそのまま OOP 的にしただけのもの
    - 部分 SQL のコンポーネント化とかはやりにくそう？
- イベントはあるけどスキーマ操作系のみ
    - DML はロギングのみ？

## zendframework/zend-db

- https://github.com/zendframework/zend-db
- 素のクエリは array と ArrayObject のどちらも返せる
    - 任意のオブジェクトをプロトタイプにできる
    - fetch 系が無くて PDO よりも貧弱？
    - オブジェクトを返すもの、というポリシーを感じる
- ResultSet や ArrayObject をプロトタイプパターンでカスタマイズできる
    - ArrayObjectPrototype は ArrayObject か exchangeArray() を実装したオブジェクト
    - ResultSetPrototype は PDOStatement とかをラップするイテレーター
- テーブルゲートウェイが基本でそれ以外だと query ぐらいしかできない
    - よくある insert/update/delete とかもない
    - そういうのはテーブルゲートウェイにある
- テーブルゲートウェイでもメタデータとかはあんまり使えない
    - 存在しない列名がデータに含まれていても無視したりしない
    - メタデータのキャッシュも標準では無し？
- テーブルゲートウェイの update/delete とかにはそこそこ複雑な条件もできる
- RowDataGateway もオプションで使える
- テーブルゲートウェイは FeatureSet でいろいろなフックポイントで処理できる
- トランザクションがサッと開始できない
    - $db->getDriver()->getConnection()->beginTransaction();

## icomefromthenet/DBALGateway

- https://github.com/icomefromthenet/DBALGateway
- start/end のようにメソッドチェインでブロックを表現するのが微妙な感じする
- メソッドチェインで型情報が失われているっぽい

## kapv89/div

- https://github.com/kapv89/div
- 非常に多機能な感じする
- スコープの概念が面白い

## まとめ

**生のクエリ**

- doctrine/dbal
    - PDO にちょっと付け足したぐらい
- zend-db
    - オブジェクトを返すのが基本なので fetch 系のメソッドが無く常に Iterator が返る

**クエリビルダ**

- doctrine/dbal
    - 微妙に使いにくい？
    - SQL をそのまま OOP 風に書けるようにした雰囲気
- zend-db
    - クエリビルダ自体は書きやすい？
    - 実行がメソッドチェインでさらっと出来ないのが面倒？

**テーブルゲートウェイ**

- doctrine/dbal
    - ない
- zend-db
    - 普通の DML は一通りできる
    - フックポイントを入れたり出来る
