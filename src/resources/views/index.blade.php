@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('link')
@endsection

@section('content')
    @foreach($stores as $store)
    <div class="shop">
        <img class="shop_img" src="{{ asset('img/' . $store->store_id . '.jpg') }}" alt="{{ $store->name }}の店舗画像">
        <div class="shop_content">
            <h3>{{ $store->name }}</h3>
            <p>#{{ $store->area->name }} #{{ $store->genre->name }}</p>
            <a href="{{ route('store.detail', ['store_id' => $store->store_id]) }}">詳しくみる</a>
        </div>
        <div class="heart-icon"></div>
    </div>
    @endforeach
@endsection
