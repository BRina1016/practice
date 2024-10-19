@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('link')
@endsection

@section('content')
    <div class="detail-shop">
        <div class="detail-shop_content">
            <h3>{{ $store->name }}</h3>
        </div>
        <img class="detail-shop_img" src="{{ asset('img/' . $store->store_id . '.jpg') }}" alt="{{ $store->name }}の店舗画像">
        <div class="detail-shop_content">
            <a class="shop_tag">#{{ $store->area->name }}</a>
            <a class="shop_tag">#{{ $store->genre->name }}</a>
            <p class="shop_description">{{ $store->description }}</p>
        </div>
    </div>
    <div class="reservation">
        <div class="reservation_content">
            <h3>予約</h3>
        </div>
    </div>
@endsection
