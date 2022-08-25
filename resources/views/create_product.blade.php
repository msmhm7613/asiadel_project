@extends('layout')
@section('title','ثبت آگهی جدید')
@section('content')
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h4 class="alert alert-info">ثبت آگهی جدید</h4>
        <form action="{{ Route('user.create.product') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input class="form-control" name="title" required placeholder="عنوان کالا یا مزایده را وارد کنید" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <input class="form-control" name="price" required placeholder="قیمت کالا یا مزایده به ریال را وارد کنید" value="{{ old('price') }}">
            </div>
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="توضیحاتی در مورد آگهی خود بدهید">{{ old('body') }}</textarea>
            </div>
            <div class="form-group">
                <h5>تصویر شاخص کالا</h5>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="form-control">
                <h5 class="alert alert-info">ویژگی های محصول را وارد کنید</h5>
                <div class="col-md-5"><input class="form-control" required name="key[]" placeholder="عنوان ویژگی"></div>
                <div class="col-md-5"><input class="form-control" required name="value[]" placeholder="مقدار ویژگی"></div>
                <div class="col-md-2"><button type="button" class="btn btn-sm" onclick="add_attr()">+</button></div>
                <div class="form-group" id="div_attr"></div>
            </div>
            <hr>
            <br>
            <div class="form-group">
                <input class="form-control" name="from_date" required placeholder="تاریخ و ساعت شروع مزایده" value="{{ old('from_date') }}">
                <small>مثال : <span dir="ltr">1401-05-31 14:35:00</span> </small>
            </div>
            <div class="form-group">
                <input class="form-control" name="to_date" required placeholder="تاریخ و ساعت پایان مزایده" value="{{ old('to_date') }}">
                <small>مثال : <span dir="ltr">1401-05-31 14:35:00</span> </small>
            </div>
            <div class="form-group">
                <input class="form-control" name="pay_date" required placeholder="حداکثر زمان پرداخت به دقیقه" value="{{ old('pay_date') }}">
            </div>
            <div class="form-group">
                <button class="btn btn-success">ثبت آگهی</button>
            </div>
        </form>
    </div>
@endsection
