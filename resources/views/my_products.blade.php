@extends('layout')
@section('title','آگهی های من')
@section('content')
    <h4>آگهی های من</h4>

    @if(count($products))
        <table class="table table-stripped">
            <thead>
            <tr>
                <th>عنوان</th>
                <th>تصویر</th>
                <th>قیمت</th>
                <th>وضعیت</th>
                <th>زمان آغاز</th>
                <th>زمان پایان</th>
                <th>مهلت پرداخت</th>
                <th>پیشنهادها</th>
                <th>امکانات</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td><img src="{{ asset($item->image) }}" width="50px" height="50px"></td>
                    <td>{{ number_format($item->price) }} ریال</td>
                    <td>
                        @switch($item->status)
                            @case(0)
                                <span class="btn btn-sm btn-info">ایجاد شده</span>
                                @break
                            @case(1)
                                <span class="btn btn-sm btn-warning">انتخاب شده</span>
                                @break
                            @case(2)
                                <button class="btn btn-sm btn-success" type="button" data-toggle="modal"
                                        data-target="#modal_{{ $item->id }}">آماده ارسال
                                </button>
                                @break
                            @case(3)
                                <span class="btn btn-sm btn-success">ارسال شده</span>
                                @break
                            @default

                        @endswitch
                    </td>
                    <td dir="ltr">{{ $item->from_date }}</td>
                    <td dir="ltr">{{ $item->to_date }}</td>
                    <td>{{ $item->pay_date }} دقیقه</td>
                    <td>{{ count($item->offers) }}</td>
                    <td><a href="{{ Route('user.product',['slug' => $item->slug]) }}"><i
                                class="glyphicon glyphicon-info-sign" title="بررسی پیشنهاد ها"></i></a></td>
                </tr>
                @if($item->order_info)
                {{--modal code--}}
                <div id="modal_{{ $item->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">ارسال سفارش</h4>
                            </div>
                            <div class="modal-body text-center" dir="rtl">
                                <h4 class="alert alert-info">اطلاعات سفارش</h4>
                                <b>خریدار : {{ $item->buyer_info['fullname'] }}</b><hr>
                                <b>همراه : {{ $item->order_info['cellphone'] }}</b><hr>
                                <b>آدرس : {{ $item->order_info['address'] }}</b><hr>
                                <b>مبلغ پرداختی : {{ number_format($item->order_info['price']) }} ریال</b><hr>
                                <a href="{{ Route('user.create.order.get',['order_id' => $item->order_id]) }}" class="btn btn-info">ارسال سفارش</a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                            </div>
                        </div>

                    </div>
                </div>
                {{--    end modal--}}
                @endif

            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">هیچ آگهی توسط شما ثبت نشده است ، اولین آگهی خود را ثبت کنید</div>
    @endif
@endsection
