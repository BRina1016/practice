<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予約確認書</title>
    <style>
        @font-face {
            font-family: 'ipag';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/ipag.ttf') }}") format("truetype");
        }

        body {
            font-family: 'ipag';
            margin: 40px;
            color: #333;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 140px;
        }

        .box {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #666;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="title">予約確認書</div>

    <div class="box">
        <div class="section">
            <span class="label">予約番号:</span>
            {{ 'RSV-' . str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}
        </div>

        <div class="section">
            <span class="label">店舗名:</span>
            {{ $reservation->store->store_name ?? '未設定' }}
        </div>

        <div class="section">
            <span class="label">予約日:</span>
            {{ $reservation->date }}
        </div>

        <div class="section">
            <span class="label">予約時間:</span>
            {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}
        </div>

        <div class="section">
            <span class="label">人数:</span>
            {{ $reservation->number_of_people }}名
        </div>

        <div class="section">
            <span class="label">予約者名:</span>
            {{ $reservation->user->name }}
        </div>

        <div class="section">
            <span class="label">メールアドレス:</span>
            {{ $reservation->user->email }}
        </div>
    </div>

    <div class="footer">
        発行日: {{ now()->format('Y-m-d H:i') }}
    </div>
</body>
</html>