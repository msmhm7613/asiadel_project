@extends('layout')
@section('title','پیشنهاد های من')
@section('content')
    <h4>پیشنهاد های من : {{ count($offers) }} مورد</h4>
    @if(count($offers))
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>عنوان</th>
                    <th>قیمت پایه</th>
                    <th>پیشنهاد شما</th>
                    <th>وضعیت</th>
                    <th>مهلت پرداخت</th>
                    <th>ابزار</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $item)
                    <tr>
                        <td><a href="{{ Route('user.product',['slug' => $item->pro_slug]) }}">{{ $item->pro_title }}</a></td>
                        <td>{{ number_format($item->pro_price) }} ریال</td>
                        <td>{{ number_format($item->price) }} ریال</td>
                        <td>
                            @if($item->status == 0)
                                <b class="text-warning">پیشنهاد شده</b>
                            @elseif($item->status == 1)
                                <b class="text-success">پذیرفته شده</b>
                            @elseif($item->status == 2)
                                <b class="text-success">پرداخت شده</b>
                            @elseif($item->status == 3)
                                <b class="text-success">ارسال شده</b>
                            @else
                                <b class="text-info">لغو شده</b>
                            @endif
                        </td>
                        <td dir="ltr" style="text-align: right">{{ $item->pay_date }}</td>
                        <td>
                            @if($item->pay_date > Verta::now() && $item->status != 3)
                                <a href="{{ Route('user.form.order',['offer_id' => $item->id]) }}" class="btn btn-success btn-sm">پرداخت</a>
                            @elseif(Verta::now() > $item->pay_date && $item->status != 3)
                                <span class="btn btn-danger btn">عدم پرداخت</span>
                            @else

                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">هیچ پیشنهادی توسط شما ثبت نشده است</div>
    @endif
@endsection
