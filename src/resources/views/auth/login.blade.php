@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css')}}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('link')
@endsection

@section('content')
<div class="login">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="login_head">Login</h2>

                <div class="login_card">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end form-group_icon">
                                <span class="material-icons">email</span>
                            </label>

                            <div class="col-md-6 form-control">
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-end form-group_icon">
                                <span class="material-icons">lock</span>
                            </label>

                            <div class="col-md-6  form-control">
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4 login_card_btn">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ログイン') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
