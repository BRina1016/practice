@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
<script src="{{ asset('js/detail.js') }}"></script>
@endsection

@section('link')
@endsection

@section('content')
    <div class="detail-shop">
        <div class="detail-shop_content">
            <div class="detail-shop_content__back">
                <a href="/" class="back-button">&lt;</a>
            </div>
            <h3 class="detail-shop_content__name" >{{ $store->name }}</h3>
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
            <form id="reservationForm" action="{{ url('/detail/' . $store->store_id . '/complete') }}" method="POST">
            @csrf
            <input class="reservation_calendar" type="date" id="dateInput" name="date" required>

            <div class="reservation_box">
                <select class="reservation_time" id="reservation_hour" name="hour" required>
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
                <select id="reservation_minute" name="minute" required>
                    @for ($i = 0; $i < 60; $i += 5)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
            </div>
            <div class="reservation_box">
                <select id="number_of_people" name="number_of_people" required>
                    <option value="" disabled selected></option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}人</option>
                    @endfor
                </select>
            </div>

            <div class="selection-display">
                <div class="selection-display__content">
                    <table><tbody>
                        <tr>
                            <th class="selection-display__title">Shop</th>
                            <td class="selection-display__text">{{ $store->name }}</td>
                        </tr>
                        <tr>
                            <th class="selection-display__title">Date</th>
                            <td class="selection-display__text" id="display-date">
                                <p><span id="previewDate">未選択</span></p>
                            </td>
                        </tr>
                        <tr>
                            <th class="selection-display__title">Time</th>
                            <td class="selection-display__text" id="display-time">
                                <p><span id="previewHour">--</span> : <span id="previewMinute">--</span></p>
                            </td>
                        </tr>
                        <tr>
                            <th class="selection-display__title">Number</th>
                            <td class="selection-display__text" id="display-number">
                                <p><span id="previewPeople">未選択</span></p>
                            </td>
                        </tr>
                    </tbody></table>
                </div>
            </div>

            <div class="reservation-box">
                <button type="submit" class="reservation-box__button">予約する</button>
            </div>
            </form>
        </div>
    </div>
@endsection
