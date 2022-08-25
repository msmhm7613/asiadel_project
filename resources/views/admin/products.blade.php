@extends('admin.layout')
@section('title','مدیریت آگهی ها')
@section('content')
    @if(count($products))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>قیمت</th>
                    <th>وضعیت</th>
                    <th>شروع مزایده</th>
                    <th>پایان مزایده</th>
                    <th>مدت پرداخت</th>
                    <th>امکانات</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($products as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td><?= ($item->status) ? '<span class="text-success">فروخته شد</span>' : '<span class="text-warning">ایجاد شده</span>' ?></td>
                        <td style="direction: ltr">{{ $item->from_date }}</td>
                        <td style="direction: ltr">{{ $item->to_date }}</td>
                        <td>{{ $item->pay_date }} دقیقه</td>
                        <td>
                            <i class="glyphicon glyphicon-info-sign" title=""></i>
                            <a href="{{ Route('admin.delete.product',['id' => $item->id]) }}"><i class="glyphicon glyphicon-trash" title="حذف کالا"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    @else
        <div class="alert alert-warning">هیچ آگهی در سیستم ثبت نشده است</div>
    @endif
@endsection
