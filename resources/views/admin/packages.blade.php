@extends('admin.layout')
@section('title','کوپن ها')
@section('content')
    <h4>مدیریت کوپن ها : {{ count($packages) }} مورد</h4>
    @if(count($packages))
        <table class="table table-hover">
            <thead>
            <tr>
                <th>عنوان</th>
                <th>قیمت</th>
                <th>تعداد پیشنهاد</th>
                <th>توضیحات</th>
                <th>ابزار</th>
            </tr>
            </thead>
            <tbody>
            @foreach($packages as $pkg)
                <tr>
                    <td>{{ $pkg->title }}</td>
                    <td>{{ number_format($pkg->price) }} ریال</td>
                    <td>{{ $pkg->qui }}</td>
                    <td>{{ $pkg->body }}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">اولین بسته پیشنهادی را ثبت کنید !</div>
    @endif
@endsection
