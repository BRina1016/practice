@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('link')
@endsection

@section('content')
<div class="done_card">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="done_card-body">
                <div class="done_card-body">
                    <p>ご予約ありがとうございます。</p>
                    <a href="/" class="btn btn-primary">戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection