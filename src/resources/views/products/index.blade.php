<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
</head>

<body>
    <h1>商品一覧</h1>

    <a href="/products/register">商品を追加</a>

    <form action="/products/search" method="GET">
        <input type="text" name="keyword" placeholder="商品名で検索">
        <button type="submit">検索</button>
    </form>

    <div class="sort-area">
        <h3>価格順で表示</h3>

        <form method="GET" action="{{ url()->current() }}">

            <select name="sort" onchange="this.form.submit()">
                <option value="">並び替えを選択</option>
                <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>
                    価格が低い順
                </option>
                <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>
                    価格が高い順
                </option>
            </select>
            @if(request('keyword'))
            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            @endif
            @if ($sort)
            <div class="sort-tag">
                <span>
                    {{ $sort === 'price_asc' ? '価格が低い順' : '価格が高い順' }}
                </span>

                <a href="{{ request()->url() }}{{ request('keyword') ? '?keyword=' . request('keyword') : '' }}">
                    ×
                </a>
            </div>
            @endif
        </form>
    </div>

    @if (request()->has('keyword'))
    <a href="/products">一覧に戻る</a>
    @endif

    <ul>
        @foreach ($products as $product)
        <li>
            <a href="/products/{{ $product->id }}">
                {{ $product->name }} ： {{ $product->price }}円
            </a>
        </li>
        @endforeach
    </ul>
</body>

</html>