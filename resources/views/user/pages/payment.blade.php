@extends('user.layouts.app')

@section('content')
<h2>Nhập số tiền thanh toán</h2>
    <form action="{{ route('vnpay.payment') }}" method="POST">
        @csrf
        <label for="amount">Số tiền (VNĐ):</label>
        <input type="number" name="amount" required min="1000" step="1000">
        <br><br>
        <button type="submit">Thanh toán với VNPAY</button>
    </form>
@endsection