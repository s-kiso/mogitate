@extends('layouts.app')

@section('content')
<form action="/img" enctype="multipart/form-data" method="post">
    @csrf
    <input type="file" name="imgpath">
    <input type="submit" value="アップロードする">
</form>

<img src=" {{ asset('storage/banana.png') }}" alt="">
@endsection