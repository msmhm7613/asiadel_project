@extends('layout')
@section('title','سبد خرید')
@section('content')
    <h4>سبد خرید شما</h4>
    <div class="col-md-3"></div>
    <div class="col-md-6">
        @if($cart)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>عنوان پکیج</th>
                    <th>تعداد پیشنهاد</th>
                    <th>قیمت</th>
                    <th>امکانات</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>{{ $cart->title }}</td>
                    <td>{{ $cart->qui }} عدد</td>
                    <td>{{ number_format($cart->price) }} ریال</td>
                    <td><a href="{{ Route('user.delete.userOfferPkg',['pkg_id' => $cart->id]) }}"><i
                                class="glyphicon glyphicon-trash" title="حذف بسته"></i></a></td>
                </tr>

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2">مبلغ قابل پرداخت : <span class="btn btn-danger">{{ number_format($cart->price) }} ریال</span></td>
                    <td colspan="2"><a href="{{ Route('bank') }}" class="btn btn-info">اتصال به درگاه و پرداخت</a></td>
                </tr>
                </tfoot>
            </table>
        @else
            <div class="alert alert-warning">سبد خرید شما خالیست</div>
        @endif
    </div>
    <div class="col-md-3"></div>
@endsection
