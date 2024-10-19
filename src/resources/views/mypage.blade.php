@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('link')
@endsection

@section('content')
<h2>testさん</h2>
<div class="mypage_content reservation_content">
    <h3>予約業況</h3>
    <div class="mypage_reservation">
        <h4><span class="material-icons mypage_reservation-icon">watch_later</span>予約1</h4>
        <div class="selection-display">
            <div class="selection-display__content">
                <table><tbody>
                    <tr>
                        <th class="selection-display__title">Shop</th>
                        <td class="selection-display__text">テキスト</td>
                    </tr>
                    <tr>
                        <th class="selection-display__title">Date</th>
                        <td class="selection-display__text">テキスト</td>
                    </tr>
                    <tr>
                        <th class="selection-display__title">Time</th>
                        <td class="selection-display__text">テキスト</td>
                    </tr>
                    <tr>
                        <th class="selection-display__title">Number</th>
                        <td class="selection-display__text">テキスト</td>
                    </tr>
                </tbody></table>
            </div>
        </div>
    </div>
</div>
<div class="mypage_content">
    <h3>お気に入り店舗</h3>
    @foreach ($stores->take(2) as $store)
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
</div>
@endsection
