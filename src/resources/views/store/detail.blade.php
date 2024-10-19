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
            <form>
            <input class="reservation_calendar" type="date" id="dateInput" value="2024-10-20">
            <div class="reservation_box">
                <select class="reservation_time" id="reservation_hour" name="reservation_hour">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                </select>
                <p class="reservation_time">:</p>
                <select class="reservation_time" id="reservation_minute" name="reservation_minute">
                    <option value="00">00</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="reservation_box">
                <select class="reservation_time" id="reservation_hour" name="reservation_hour">
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                    <option value="4">4人</option>
                    <option value="5">5人</option>
                    <option value="6">6人</option>
                    <option value="7">7人</option>
                    <option value="8">8人</option>
                    <option value="9">9人</option>
                    <option value="10">10人</option>
                </select>
            </div>
            </form>
            <div class="selection-display">
                <div class="selection-display__content">
                    <table><tbody>
                        <tr>
                            <th class="selection-display__title">Shop</th>
                            <td class="selection-display__text">{{ $store->name }}</td>
                        </tr>
                        <tr>
                            <th class="selection-display__title">Date</th>
                            <td class="selection-display__text" id="display-date"></td>
                        </tr>
                        <tr>
                            <th class="selection-display__title">Time</th>
                            <td class="selection-display__text" id="display-time"></td>
                        </tr>
                        <tr>
                            <th class="selection-display__title">Number</th>
                            <td class="selection-display__text" id="display-number"></td>
                        </tr>
                    </tbody></table>
                </div>
            </div>
            <div class="reservation-box">
                <button class="reservation-box__button">予約する</button>
            </div>
        </div>
    </div>
@endsection
