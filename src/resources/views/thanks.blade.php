@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('link')
@endsection

@section('content')
<div class="thanks_card">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="thanks_card-body">
                <div class="thanks_card-body">
                    <p>会員登録ありがとうございます。</p>
                    <a href="{{ url('/login') }}" class="btn btn-primary">ログインする</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection