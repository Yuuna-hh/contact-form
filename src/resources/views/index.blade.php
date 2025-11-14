@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>お問い合わせ</h2>
            </div>
            <form class="form" action="/contacts/confirm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="name" placeholder="テスト太郎" value="{{ old('name') }}" />
                            <div class="form__error">
                                @error('name') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
                            <div class="form__error">
                                @error('email') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="tel" name="tel" placeholder="09012345678" value="{{ old('tel') }}" />
                            <div class="form__error">
                                @error('tel') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="content" placeholder="資料をいただきたいです">{{ old('content') }}</textarea>
                            <div class="form__error">
                                @error('content') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">画像添付</span>
                    </div>
                    <div class="form__group-content">
                        <input type="file" name="image" accept="image/*" />
                        <div class="form__error">
                            @error('image') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面へ</button>
                </div>
            </form>
        </div>
@endsection
