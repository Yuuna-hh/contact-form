@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__heading">
        <h2>お問い合わせありがとうございます</h2>
    </div>

    <div class="form__button">
        <button type="button" class="form__button-reset" onclick="location.href='/'">最初に戻る</button>
    </div>
    
</div>
@endsection