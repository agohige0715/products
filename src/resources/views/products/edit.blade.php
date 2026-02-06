<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集</title>
</head>

<body>
    <h1>商品編集</h1>

    <form action="/products/{{ $product->id }}/update" method="POST">
        @csrf

        <div>
            商品名：
            <input type="text" name="name" value="{{ $product->name }}">
        </div>

        <div>
            価格：
            <input type="number" name="price" value="{{ $product->price }}">
        </div>

        <button type="submit">更新</button>
    </form>

    <a href="/products/{{ $product->id }}">戻る</a>
</body>

</html>