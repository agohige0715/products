<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
</head>

<body>
    <h1>商品登録</h1>

    <form action="/products" method="POST">
        @csrf
        <div>
            商品名：<input type="text" name="name">
        </div>
        <div>
            価格：<input type="number" name="price">
        </div>

        <button type="submit">登録</button>

        <a href="/products">一覧に戻る</a>
    </form>
</body>

</html>