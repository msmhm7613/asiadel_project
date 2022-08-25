@extends('admin.layout')
@section('title','مدیریت کاربران')
@section('content')
    @if(count($users))
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>نام</th>
                    <th>موبایل</th>
                    <th>ایمیل</th>
                    <th>پیشنهاد باقیمانده</th>
                    <th>نقش</th>
                    <th>امکانات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->cellphone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->offer }}</td>
                        <td>{{ $item->role_title }}</td>
                        <td><a href="{{ Route('admin.delete.user',['id' => $item->id]) }}"<i class="glyphicon glyphicon-trash" title="حذف کاربر"></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    @else
        <div class="alert alert-warning">هیچ کاربری در سیستم ثبت نشده است</div>
    @endif
@endsection
