@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="register__heading">
        <h2>商品登録</h2>
    </div>

    <form action="/products/register" enctype="multipart/form-data" class="form" method="post">
        @csrf

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品名</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">値段</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            </div>
            <div class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品画像</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__input--text">
                <img src="{{ asset('storage/') }}" alt="">
            </div>
            <div class="form__input--image">
                <input type="file" name="image" accept="image/jpeg, image/png" value="">
            </div>
            <div class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </div>
            
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">季節</span>
                <span class="form__label--required">必須</span>
                <span class="form__label--multiple">複数選択可</span>
            </div>
            <div class="form__input--radio">
                @foreach($seasons as $key => $season)
                <input type="checkbox" name="seasons[{{$key}}]" value="{{ $season->id }}" @if(old("seasons.$key")=== strval($season->id)) checked @endif><label>{{ $season->name }}</label>
                @endforeach
            </div>
            <div class="form__error">
                @error('seasons')
                {{ $message }}
                @enderror
            </div>
        </div>


        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品説明</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__input--textarea">
                <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            </div>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__button">
            <a href="/products">戻る</a>
            <button class="form__button-submit" type="submit">登録</button>
        </div>

    </form>
</div>
@endsection