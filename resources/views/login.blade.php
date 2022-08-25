@extends('layout')
@section('title','ورود به سیستم')
@section('content')
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="{{ Route('user.login') }}" method="post">
            @csrf
            <h3 class="alert alert-success">ورود به سیستم</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="mobile" required placeholder="شماره همراه">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" required placeholder="کلمه عبور">
            </div>
            <div class="form-group">
                <button class="btn btn-success">ورود به سیستم</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
@endsection
