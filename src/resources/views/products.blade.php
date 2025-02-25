@extends('layouts.app')

<style>
    svg.w-5.h-5 {
        /*paginateメソッドの矢印の大きさ調整のために追加*/
        width: 30px;
        height: 30px;
    }
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="products__content">
    <div class="products__heading">
        <h2>
        @if(isset($product_name))
            "{{$product_name}}"の
        @endif
        商品一覧</h2>
        <button class="products__heading-button" type="button" onclick="location.href='/products/register'">＋ 商品を追加</button>
    </div>

    <div class="products__main">
        <div class="products__form">
            <form action="/products/search" method="get">
                <input type="text" name="product_name" value="{{$product_name ?? '' }}" placeholder="商品名で検索" class="products__input-search">
                <input type="hidden" name="product_sort" value="{{ str_replace(url('/'),"",request()->fullUrl()) }}">
                <input type="submit" value="検索" class="products__input-submit">
            </form>

            <div class="products__form-sort">
                <h3>価格順で表示</h3>
                <input type="checkbox" id="label-1">
                    <label class="select__summary" for="label-1">価格で並べ替え</label>

                    <ul class="select__detail">
                        <form method="get" name="descending" action="/products/descending">
                            <input type="hidden" name="search_data" value="{{$product_name ?? '' }}">
                            <button type="submit" class="select__button">高い順に表示</button>
                        </form>
                        <form method="get" name="ascending" action="/products/ascending">
                            <input type="hidden" name="search_data" value="{{$product_name ?? '' }}">
                            <button type="submit" class="select__button">低い順に表示</button>
                        </form>
                    </ul>

                @if($sort__type ?? '' !== "")
                    <div class="sort__tag">
                        <span class="sort__tag-text">{{$sort__type}}</span>
                        <form method="get" name="reset" action="/products/reset">
                            <input type="hidden" name="search_data" value="{{$product_name ?? '' }}">
                            <button type="submit" class="sort__tag-button">×</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="products__list">
            @foreach ($items as $item)
            <a href =" {{ route('product.detail', ['id'=>$item->id]) }}">
                <div class="product__card">
                    <div class="product__card-img">
                        <img src=" {{ asset('storage/'.$item->image) }}" alt="">
                    </div>
                    <div class="product__card-content">
                        <p>{{ $item->name }}</p>
                        <p>&yen;{{ $item->price }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        
    </div>
    <!-- ページネーション -->
    <div class="pagination">
        {{ $items->links() }}
    </div>
    


</div>


@endsection