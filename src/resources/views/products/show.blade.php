<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
</head>

<body>
    <h1>商品詳細</h1>

    <p>商品名：{{ $product->name }}</p>
    <p>価格：{{ $product->price }}円</p>

    <a href="/products/{{ $product->id }}/update">編集</a>

    <form action="/products/{{ $product->id }}/delete" method="POST"
        onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        <button type="submit">削除</button>
    </form>

    <a href="/products">一覧へ戻る</a>
</body>

</html>