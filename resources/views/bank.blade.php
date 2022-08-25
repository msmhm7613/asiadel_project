<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>درگاه بانکی</title>
</head>
<body>

    <p>مبلغ قابل پرداخت : {{ number_format($offer->price) }} ریال</p>
    <p><a href="{{ Route('user.update.order',['ref_code' => Str::random(20), 'status' => 1, 'offer_id' => $offer->id,'order_id' => $order->id]) }}">پرداخت موفق</a> ||
        <a href="{{ Route('user.update.order',['ref_code' => Str::random(20), 'status' => 2, 'offer_id' => $offer->id,'order_id' => $order->id]) }}">پرداخت ناموفق</a></p>
</body>
</html>
