<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css"
          integrity="sha512-3Lr2MkT5iW+jVhwKFUBa+zQk8Uklef98/3mebU6wNxTzj65enYrFXaeuqPAYWxcQd1GAt9aUBvYHOIcl2SUsKA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>ورود به سیستم</title>
</head>
<body style="font-family: 'B Titr'">
<div class="container">

    @if (Session::has('msg'))

        <div class="alert <?= (Session::get('status') == 1) ? 'alert-success' : 'alert-danger' ?>">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Session::get('msg') }}</strong>
        </div>

        @if(Session::get('status') == 2)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif

    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h4 class="alert alert-warning">ورود به سیستم</h4>
        <form action="{{ Route('admin.login') }}" method="post">
            @csrf
            <div class="form-group">
                <input name="cellphone" required class="form-control" placeholder="شماره همراه را وارد نمایید">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" required
                       placeholder="کلمه عبور خود را وارد نمایید">
            </div>
            <div class="form-group">
                <button class="btn btn-danger col-md-12">ورود به سیستم</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
</body>
</html>
