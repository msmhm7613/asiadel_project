@extends('admin.layout')
@section('title','ثبت کاربر جدید')
@section('content')
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="{{ Route('admin.create.user') }}" method="post">
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
                <select name="role_id" class="form-control" required>
                    <option selected disabled>انتخاب کنید</option>
                    @foreach ($roles as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success">ثبت کاربر</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
@endsection
