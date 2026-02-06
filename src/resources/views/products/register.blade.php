<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
</head>

<body>
    <h1>商品登録</h1>

    <form action="/products/register" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>商品名</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            <label>価格</label><br>
            <input type="number" name="price" value="{{ old('price') }}">
        </div>

        <div>
            <label>商品画像</label><br>
            <input type="file" name="image">
        </div>

        <div>
            <label>商品説明</label><br>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label>季節</label><br>
            @foreach ($seasons as $season)
            <label>
                <input
                    type="radio"
                    name="season_id"
                    value="{{ $season->id }}"
                    {{ old('season_id') == $season->id ? 'checked' : '' }}>
                {{ $season->name }}
            </label>
            @endforeach
        </div>

        <button type="submit">登録</button>
    </form>
</body>

</html>