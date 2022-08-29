<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css" integrity="sha512-3Lr2MkT5iW+jVhwKFUBa+zQk8Uklef98/3mebU6wNxTzj65enYrFXaeuqPAYWxcQd1GAt9aUBvYHOIcl2SUsKA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="{{ asset('core.js') }}" type="text/javascript"></script>
</head>
<body style="font-family: B jadid">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">مزایده</a>
      </div>
      <ul class="nav navbar-nav">
          <li><a href="{{ Route('user.offer_package') }}">بسته های پیشنهادی</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">آگهی ها
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ Route('user.main') }}">همه آگهی ها</a></li>
            <li><a href="{{ Route('user.my_products') }}">آگهی ها من</a></li>
            <li><a href="{{ Route('user.form.product') }}">ثبت آگهی جدید</a></li>
          </ul>
        </li>
        @if(Auth::check())
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">ناحیه کاربری
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">پیشنهاد باقیمانده : {{ Auth::user()->offer }}</a></li>
              <li><a href="{{ Route('user.my_offers') }}">پیشنهاد های من</a></li>
              <li><a href="{{ Route('user.logout') }}">خروج از سیستم</a></li>
            </ul>
          </li>
            <li><a href="#">خوش آمدید : {{ Auth::user()->fullname }}</a></li>
        @else
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">ناحیه کاربری
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ Route('user.form.register') }}">ثبت نام</a></li>
              <li><a href="{{ Route('user.form.login') }}">ورود به سیستم</a></li>
            </ul>
          </li>
        @endif
        {{-- <li><a href="#">Page 3</a></li> --}}
      </ul>

    </div>
  </nav>
<br>

<div class="container-fluid" dir="rtl">
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
  <div class="col-md-12">
      @yield('content')
  </div>
</div>

</body>
</html>
