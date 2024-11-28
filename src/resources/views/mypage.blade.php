@extends('layouts.app')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=favorite" />
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/mypage.js') }}"></script>
@endsection

@section('content')
<h2>{{ $user->name }}さん</h2>

<div class="mypage_content reservation_content">
    <h3>予約状況</h3>
    @foreach ($reservations as $index => $reservation)
    <div class="mypage_reservation">
        <h4>
            <span class="material-icons mypage_reservation-icon">watch_later</span>
            <span class="mypage_reservation-text">予約{{ $index + 1 }}</span>
            <form class="delete-button__form" action="{{ route('reservation.delete', ['id' => $reservation->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">×</button>
            </form>
        </h4>
        <div class="selection-display">
            <div class="selection-display__content">
                <table>
                    <tbody>
                        <tr>
                            <th class="selection-display__title">Shop</th>
                            <td class="selection-display__text">{{ $reservation->store ? $reservation->store->name : '店舗情報がありません' }}</td>
                        </tr>
                        <tr>
                            <th class="selection-display__title">Date</th>
                            <td class="selection-display__text">{{ $reservation->date }}</td>
                        </tr>
                        <tr>
                            <th class="selection-display__title">Time</th>
                            <td class="selection-display__text">{{ \Carbon\Carbon::createFromFormat('H:i:s', $reservation->time)->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="selection-display__title">Number</th>
                            <td class="selection-display__text">{{ $reservation->number_of_people }}人</td>
                        </tr>
                    </tbody>
                </table>
                <button class="edit-button" data-reservation-id="{{ $reservation->id }}">予約変更</button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mypage_content">
    <h3>お気に入り店舗</h3>
    @foreach($stores as $store)
    <div class="shop" data-store-id="{{ $store->store_id }}">
        <img class="shop_img" src="{{ asset('img/' . $store->store_id . '.jpg') }}" alt="{{ $store->name }}の店舗画像">
        <div class="shop_content">
            <h3>{{ $store->name }}</h3>
            <p>#{{ $store->area->name }} #{{ $store->genre->name }}</p>
            <a href="{{ route('store.detail', ['store_id' => $store->store_id]) }}">詳しくみる</a>
        </div>
        <div class="heart-icon material-symbols-outlined {{ in_array($store->store_id, $favorites) ? 'favorited' : '' }}" data-store-id="{{ $store->store_id }}">favorite</div>
    </div>
    @endforeach
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <form id="editReservationForm" method="POST">
            @csrf
            @method('PATCH') <!-- PATCH メソッドを指定 -->
            <input type="hidden" id="reservationId" name="reservation_id">
            <div class="reservation_calendar">
                <label for="dateInput">Date</label>
                <input type="date" id="dateInput" name="date" required>
            </div>
            <div class="reservation_box">
                <label for="reservation_hour">Time</label>
                <select class="reservation_time" id="reservation_hour" name="hour" required>
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
                <span style="color:#000;">:</span>
                <select id="reservation_minute" name="minute" required>
                    @for ($i = 0; $i < 60; $i += 5)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
            </div>
            <div class="reservation_box">
                <label for="number_of_people">Number</label>
                <select id="number_of_people" name="number_of_people" required>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}人</option>
                    @endfor
                </select>
            </div>
            <button type="submit" id="saveReservation">保存</button>
        </form>
        <button class="close-modal">×</button>
    </div>
</div>
@endsection
