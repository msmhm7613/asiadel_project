@extends('layout')
@section('title','ثبت اطلاعات سفارش')
@section('content')
    <h4>ثبت سفارش</h4>
    <table class="table table-hover text-center">
        <tr>
            <td>{{ $product->title }}</td>
            <td>قیمت پایه : {{ number_format($product->price) }} ریال</td>
            <td>مهلت پرداخت : <span dir="ltr">{{ $offer->pay_date }}</span></td>
            <td>پیشنهاد شما : {{ number_format($offer->price) }} ریال</td>
        </tr>
    </table>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        @if($offer->pay_date > Verta::now())
            <h4 class="alert alert-info">اطلاعات تکمیلی سفارش</h4>
            <form action="{{ Route('user.create.order') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="number" class="form-control" required value="{{ old('cellphone') }}" name="cellphone" placeholder="شماره همراه">
                </div>
                <div class="form-group">
                    <textarea name="address" class="form-control" required placeholder="آدرس دریافت سفارش">{{ old('address') }}</textarea>
                </div>
                <div class="form-group">
                    <textarea name="description" class="form-control" placeholder="توضیحات بیشتری بدهید">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <input hidden name="price" value="{{ $offer->price }}">
                    <input hidden name="pro_id" value="{{ $offer->pro_id }}">
                    <input hidden name="offer_id" value="{{ $offer->id }}">
                    <button class="btn btn-success">ثبت اطلاعات سفارش و پرداخت</button>
                </div>
            </form>
        @else
            <div class="alert alert-warning">مهلت پرداخت هزینه ی پیشنهاد تمام شده است</div>
        @endif
    </div>
    <div class="col-md-4"></div>
@endsection
