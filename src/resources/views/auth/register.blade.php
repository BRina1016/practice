@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('link')
@endsection

@section('content')
<div class="register">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="register_head">Registration</h2>
            <div class="register_card">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-group_icon">
                                <span class="material-icons">person</span>
                            </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Username" required autofocus>
                            @error('name')
                                <span class="text-danger" role="alert">
                                    {{ $message ?: 'ユーザーネームを入力してください。' }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-group_icon">
                                <span class="material-icons">email</span>
                            </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required>
                            @error('email')
                                <span class="text-danger" role="alert">
                                    {{ $message ?: 'メールアドレスを入力してください。' }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-group_icon">
                                <span class="material-icons">lock</span>
                            </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                            @error('password')
                                <span class="text-danger" role="alert">
                                    {{ $message ?: 'パスワードを入力してください。' }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0 register_card_btn">
                            <button type="submit" class="btn btn-primary">
                                {{ __('登録') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
