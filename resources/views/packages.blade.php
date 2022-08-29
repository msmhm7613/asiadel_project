@extends('layout')
@section('title','بسته های پیشنهادی')
@section('content')
    @if(count($packages))
        <div class="alert alert-info"><h4>بسته های پیشنهادی </h4><br><small>پس از به اتمام رسیدن تعداد پیشنهادات ، با
                خرید این بسته ها تعداد پیشنهادات خود را افزایش دهید</small>
            @if(!Auth::check())
                <br><small>در صورتیکه قصد خرید بسته ای را دارید ، ابتدا ثبت نام و یا وارد سیستم شوید !</small>
            @endif
        </div>
        @foreach($packages as $pkg)
            <div class="col-md-3" style="background-color: aquamarine;padding: 10px;border-radius: 10px">
                <img src="{{ asset('default.png') }}" width="100%" height="180px">
                <hr>
                <h4>{{ $pkg->title }}</h4><h6>{{ $pkg->qui }} پیشنهاد</h6>
                <hr>
                <span class="btn btn-sm btn-warning">قیمت : {{ number_format($pkg->price) }} ریال</span>
                @if(Auth::check())
                    <a href="{{ Route('user.create.offerPkg',['pkg_id' => $pkg->id]) }}" class="btn btn-sm btn-danger" style="float: left">خرید بسته</a>
                @endif
            </div>
        @endforeach
    @else
        <div class="alert alert-warning">هیچ بسته پیشنهادی در سیستم ثبت نشده است</div>
    @endif
@endsection
