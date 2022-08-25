@extends('admin.layout')
@section('title','پیشخوان')
@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h4 class="alert alert-info">خوش آمدید : {{ Auth::user()->fullname }}</h4>
    </div>
    <div class="col-md-2"></div>
@endsection
