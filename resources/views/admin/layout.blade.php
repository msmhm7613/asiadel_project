<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css"
          integrity="sha512-3Lr2MkT5iW+jVhwKFUBa+zQk8Uklef98/3mebU6wNxTzj65enYrFXaeuqPAYWxcQd1GAt9aUBvYHOIcl2SUsKA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('core.js') }}" type="text/javascript"></script>
</head>
<body style="font-family: B jadid">
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">مدیریت سایت</a>
        </div>
        <ul class="nav navbar-nav">
            @if(in_array(8, session('access_id')))
                <li class="active"><a href="{{ Route('admin.roles') }}">مدیریت نقش ها</a></li>
            @endif
            @if(in_array(1, session('access_id')) || in_array(2, session('access_id')) )
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">آگهی ها
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(in_array(1, session('access_id')))
                            <li><a href="{{  Route('admin.products') }}">مدیریت آگهی ها</a></li>
                        @endif
                        @if(in_array(2, session('access_id')))
                            <li><a href="{{ Route('admin.form.product') }}">ثبت آگهی جدید</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(in_array(3, session('access_id')) || in_array(4, session('access_id')) )
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">کوپن پیشنهاد
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(in_array(3,session('access_id')))
                            <li><a href="{{ Route('admin.offer_pkg') }}">مدیریت کوپن ها</a></li>
                        @endif
                        @if(in_array(4,session('access_id')))
                            <li><a href="{{ Route('admin.form.offer_pkg') }}">ثبت کوپن جدید</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(in_array(5, session('access_id')) || in_array(6, session('access_id')) )

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">کاربران
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(in_array(5,session('access_id')))
                            <li><a href="{{ Route('admin.users') }}">مدیریت کاربران</a></li>
                        @endif
                        @if(in_array(6,session('access_id')))
                            <li><a href="{{ Route('admin.form.user') }}">ثبت کاربر جدید</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">خوش آمدید : {{ Auth::user()->fullname }}
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ Route('user.logout') }}">خروج از سیستم</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<br>

<div class="container-fluid" dir="rtl">
    <h3>@yield('title')</h3>
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
    <div class="col-md-2">&nbsp;</div>
    <div class="col-md-8">
        @yield('content')
    </div>
    <div class="col-md-2">&nbsp;</div>
</div>

</body>
</html>
