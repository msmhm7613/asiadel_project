@extends('layout')
@section('title','ثبت نام')
@section('content')
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h4 class="alert alert-info">ثبت نام</h4>
        <form action="{{ Route('user.register') }}" method="post">
            @csrf
            <div class="form-group">
                <input class="form-control" required name="fullname" placeholder="نام و نام خانوادگی" value="{{ old('fullname') }}">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" required name="email" placeholder="پست الکترونیک " value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <input class="form-control" required name="cellphone" placeholder="شماره همراه" value="{{ old('cellphone') }}">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" required name="password" placeholder="کلمه عبور">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" required name="same_password" placeholder="تکرار کلمه عبور">
            </div>
            <div class="form-group">
                <button class="btn btn-success">ثبت نام</button>
            </div>

        </form>
    </div>
    <div class="col-md-4"></div>
@endsection
