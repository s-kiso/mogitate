@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail__content">
    <div class="breadcrumb">
        <p><a href="/products">商品一覧</a> > {{ $item->name }}</p>
    </div>

    <form action="/products/{id}/update" enctype="multipart/form-data" class="update-form" method="post">
        @method('PATCH')
        @csrf

        <div class="form__group--top">
            <div class="form__group--left">
                <div class="form__img">
                    <img src=" {{ asset('storage/'.$item->image) }}" alt="">
                </div>
                <div class="form__img--text">
                    <input type="file" name="image" accept="image/jpeg, image/png" value="{{ $item->image }}">
                </div>
                <div class="form__error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form__group--right">
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">商品名</span>
                    </div>
                    <div class="form__input--text">
                        <input type="text" name="name" value="{{ $item->name }}">
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
                    </div>
                    <div class="form__input--text">
                        <input type="text" name="price" value="{{ $item->price }}">
                    </div>
                    <div class="form__error">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">季節</span>
                    </div>
                    <div class="form__input--checkbox">
                        @foreach($season_list as $season => $name)
                        <label>
                            <input type="checkbox" name="seasons[]" value="{{ $season }}" {{ $item->seasons->contains($season) ? 'checked' : '' }}> {{ $name }}
                        </label>
                        @endforeach
                    </div>
                    <div class="form__error">
                        @error('seasons')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form__group--under">
            <div class="form__group-title">
                <span class="form__label--item">商品説明</span>
            </div>
            <div class="form__input--textarea">
                <textarea name="description">{{ $item->description }}</textarea>
            </div>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__group">
            <input type="hidden" name="id" value="{{ $item->id }}">
        </div>

        <div class="form__button">
            <a href="/products">戻る</a>
            <button class="form__button-submit" type="submit">変更を保存</button>
    </form>

    <form class="delete-form" action="/products/{id}/delete" method="post">
        @method('DELETE')
        @csrf
            <input  type="hidden" name="id" value="{{ $item->id }}">
            <button class="delete-form__button-submit" type="submit">
                <img src=" {{ asset('storage/'.'delete_button.png') }}" alt="">
            </button>
        </div>
    </form>
</div>
@endsection