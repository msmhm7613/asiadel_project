@extends('layout')
@section('title','سامانه مزایده')

@section('content')

    @yield('slider')

    @if(count($new_products))

        <div class="col-md-12">
            <h4 class="alert alert-info">جدید ترین ها : </h4>
            @foreach ($new_products as $item)
                <a href="{{ Route('user.product',['slug' => $item->slug]) }}">
                    <div class="col-md-4">
                        <img src="{{ asset($item->image) }}" height="200px" width="100%" alt="{{ $item->title }}">
                        <hr>
                        <b class="text-info">{{ $item->title }}</b>
                        <hr>
                        <small>
                            @php
                                $len = strlen($item->body);
                                if($len > 30){
                                    echo mb_substr($item->body, 0, 29, mb_detect_encoding($item->body)) . "...";
                                } else {
                                    echo $item->body;
                                }
                            @endphp
                        </small>
                    </div>
                </a>
            @endforeach
        </div>

    @else
        <div class="alert alert-warning">هیچ آگهی قابل پیشنهادی وجود ندارد</div>
    @endif

@endsection
