@extends('admin.layout')
@section('title','ثبت کوپن جدید')
@section('content')
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="title" required placeholder="عنوان بسته پیشنهاد">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="price" required placeholder="قیمت بسته به ریال">
            </div>
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="توضیحات بسته"></textarea>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="qui" placeholder="تعداد پیشنهاد" required>
            </div>
            <div class="form-group">
                <button class="btn btn-success">ثبت</button>
            </div>
        </form>
    </div>

@endsection
