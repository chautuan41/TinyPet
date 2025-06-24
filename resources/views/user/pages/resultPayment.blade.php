@extends('user.layouts.app')

@section('content')
 @if($status == 'success')
        <h2 style="color: green;">✅ Thanh toán thành công!</h2>
    @elseif($status == 'failed')
        <h2 style="color: red;">❌ Thanh toán thất bại!</h2>
    @else
        <h2>⏳ Đang xử lý...</h2>
    @endif
@endsection