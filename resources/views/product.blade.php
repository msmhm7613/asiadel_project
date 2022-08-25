@extends('layout')
@section('title',"$product->title")
@section('content')

    @auth
        {{-- modal code --}}
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" dir="rtl">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ثبت پیشنهاد</h4>
                </div>
                <div class="modal-body">

                    @if($result_check[0]['from_date'] && $result_check[0]['to_date'] && Auth::user()->offer > 0)
                        <form action="{{ Route('user.create.offer') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="number" min="{{ $product->price }}" name="price" class="form-control" placeholder="حداقل مبلغ پیشنهادی {{ number_format($product->price) }} ریال" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="pro_id" value="{{ $product->id }}">
                                <button class="btn btn-info">ثبت پیشنهاد</button>
                            </div>
                        </form>
                    @elseif($result_check[0]['from_date'] === false)
                        <div class="alert alert-warning">زمان شروع مزایده آغاز نشده است</div>
                    @elseif($result_check[0]['to_date'] === false)
                        <div class="alert alert-warning">مهلت پیشنهاد به این آگهی تمام شده است</div>
                    @elseif(Auth::user()->offer == 0)
                        <div class="alert alert-warning">تعداد پیشنهاد های شما تمام شده است</div>
                    @endif

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </div>
            </div>

            </div>
        </div>
        {{-- end modal --}}
    @endauth
    <div class="col-md-3">
        <img src="{{ asset($product->image) }}" width="100%" height="300px"><hr>
        @if(Auth::check())
            <button type="button" <?= (Auth::id() == $product->created_id) ? 'disabled' : '' ?> class="btn btn-info col-md-12" data-toggle="modal" data-target="#myModal">ثبت پیشنهاد</button>
        @else
            <div class="alert alert-danger">برای پیشنهاد دادن وارد سیستم شوید</div>
        @endif
    </div>
    <div class="col-md-6">
        <h3>{{ $product->title }}</h3><hr>
        <p style="text-align: justify">{{ $product->body }}</p><hr>
        <span class="btn btn-success">قیمت : {{ number_format($product->price) }} ریال</span>
        <b class="btn btn-sm btn-info">تاریخ و ساعت شروع : <span dir="ltr">{{ $product->from_date }}</span></b>&nbsp;
        <b class="btn btn-sm btn-info">تاریخ و ساعت پایان : <span dir="ltr">{{ $product->to_date }}</span></b>&nbsp;
        <b class="btn btn-sm btn-danger">مهلت پرداخت : {{ $product->pay_date }} دقیقه</b>

    </div>
    <div class="col-md-3" style="background-color: gainsboro">
        <h4>ویژگی ها</h4>
        @foreach ($attrs as $item)
            <b>{{ $item->key }}</b> : <b>{{ $item->value }}</b>
            <br>
        @endforeach
    </div>
    <div class="col-md-12">
        <h4>پیشنهادات</h4>
        @if(count($offers))
            @foreach ($offers as $item)
                <div class="col-md-4" style="padding:20px;<?= ($item->status == 1) ? 'background-color:gray' : '' ?>">
                    <div class="col-md-4"><img src="{{ asset('profile.png') }}" width="100%" height="100px"></div>
                    <div class="col-md-8" style="<?= ($item->status == 3) ? 'background-color: lightblue' : '' ?>">
                        <b>کاربر : {{ $item->offer_fullname }}</b><hr>
                        <b>قیمت پیشنهادی : {{ number_format($item->price) }} ریال</b>
                        @if(Auth::id() == $product->created_id)
                            @if($result_check[0]['to_date'] === false && $product->status == 0)
                                <b><a href="{{ Route('user.update.offer',['slug' => $product->slug,'offer_id' => $item->id]) }}" class="btn btn-info">انتخاب پیشنهاد</a></b>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning">هیچ پیشنهادی برای آگهی ثبت نشده است</div>
        @endif
    </div>

@endsection
