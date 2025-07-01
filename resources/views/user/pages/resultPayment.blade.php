@extends('user.layouts.app')

@section('content')
 @if($status == 2)
        <h2 style="color: green;">✅ Thanh toán thành công!</h2>
    @elseif($status == 3)
        <h2 style="color: red;">❌ Thanh toán thất bại!</h2>
    @else
        <h2>⏳ Đang xử lý...</h2>
    @endif
@endsection