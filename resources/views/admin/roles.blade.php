@extends('admin.layout')
@section('title','نقش ها')
@section('content')
    @if(count($roles))
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</td>
                    <th>عنوان</td>
                    <th>سطح دسترسی</td>
                    <th>امکانات</td>
                </tr>
            </thead>
            <body>
                @php $i = 1 @endphp
                @foreach ($roles as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @foreach($item->access as $access)
                                <small><span type="button" class="btn btn-sm btn-warning">{{ $access->access_title }}</span></small>
                            @endforeach
                    </td>
                        <td></td>
                    </tr>
                @endforeach
            </body>
        </table>
        <hr>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="{{ Route('admin.create.role') }}" method="post">
                @csrf
                <h3>تعریف نقش</h3>
                <div class="form-group">
                    <input class="form-control" name="title" required placeholder="عنوان نقش را وارد کنید">
                </div>
                <h4>دسترسی ها را انتخاب کنید</h4>
                <div class="form-group">
                    <input name="access[]" type="checkbox" value="1">&nbsp;مدیریت آگهی ها
                    <br><input name="access[]" type="checkbox" value="2">&nbsp;ثبت آگهی جدید
                    <br><input name="access[]" type="checkbox" value="3">&nbsp;مدیریت کوپن ها
                    <br><input name="access[]" type="checkbox" value="4">&nbsp;ثبت کوپن جدید
                    <br><input name="access[]" type="checkbox" value="5">&nbsp;مدیریت کاربران
                    <br><input name="access[]" type="checkbox" value="6">&nbsp;ثبت کاربر جدید
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-success">ثبت نقش</button>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    @else
        <div class="alert alert-warning">هیچ نقشی در سیستم ثبت نشده است</div>
    @endif
@endsection
