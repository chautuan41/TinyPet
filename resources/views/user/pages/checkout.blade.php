@extends('user.layouts.app')

@section('content')
<!-- about section -->

    <section class="about_section layout_padding long_section">
        <div class="container">
            <main>
                <div class="py-5 text-center">
                    <h1 class="h2">Checkout form</h1>
                    <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each
                        required form group has a validation state that can be triggered by attempting to submit the
                        form without completing it.</p>
                </div>
                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3"> <span
                                class="text-primary">Your cart</span> <span
                                class="badge bg-primary rounded-pill">{{count($data)}}</span> </h4>
                        <ul class="list-group mb-3">
                            @php
                                $totalCart = 0;
                            @endphp
                            @if(auth()->check())
                            @foreach($data as $cart)
                             @if($loop->iteration <= 5)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                 <img src="{{ asset($cart->image) }}" alt="" class="py-1 mr-3" style="with:70px;height:70px">
                                <div>
                                   
                                    <h6 class="my-0"> {{$cart->product->product_name}}</h6> 
                                    <small class="text-body-secondary">Số Lượng: 
                                        {{$cart->quantity}}
                                    </small>
                                    <small class="text-body-secondary">Trọng Lượng: 
                                        {{$cart->productDetail->size}}
                                    </small>
                                </div> 
                                <span class="text-body-secondary">{{ number_format($cart->productDetail->price, 0, ',', '.') }}</span>
                                
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                   <small class="text-body-secondary">
                                     Thành tiền
                                    </small>
                                </div> 
                                <small class="text-body-secondary">
                                <span class="text-body-secondary">{{ number_format($cart['price'] * $cart['quantity'], 0, ',', '.') }}</span>
                                 </small>
                            </li>
                           
                            @php
                                $totalCart = $totalCart + $cart->quantity * $cart->productDetail->price
                            @endphp
                            @endif
                            @endforeach
                            @if(count($data) > 5)
                            <li class="list-group-item d-flex justify-content-end"> 
                            
                               <em>...</em> </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between"> <span>Total (VND)</span>
                            
                                <strong>{{number_format($totalCart, 0, ',', '.')}}</strong> </li>
                            @else
                            @foreach($data as $id => $cart)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                 <img src="{{ asset($cart['image']) }}" alt="" class="py-1 mr-3" style="with:70px;height:70px">
                                <div>
                                   
                                    <h6 class="my-0"> {{$cart['name']}}</h6> 
                                    <small class="text-body-secondary">Số Lượng: 
                                        {{$cart['quantity']}}
                                    </small>
                                    <small class="text-body-secondary">Trọng Lượng: 
                                        {{$cart['size']}}
                                    </small>
                                    
                                </div> 
                                <span class="text-body-secondary">{{ number_format($cart['price'], 0, ',', '.') }}</span>
                                
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                   <small class="text-body-secondary">
                                     Thành tiền
                                    </small>
                                </div> 
                                <small class="text-body-secondary">
                                <span class="text-body-secondary">{{ number_format($cart['price'] * $cart['quantity'], 0, ',', '.') }}</span>
                                 </small>
                            </li>
                            
                            
                            @php
                                $totalCart = $totalCart + $cart['quantity'] * $cart['price'];
                            @endphp
                               
                            @endforeach
                            
                            <li class="list-group-item d-flex justify-content-between"> <span>Total (VND)</span>
                            
                                <strong>{{number_format($totalCart, 0, ',', '.')}}</strong> </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Billing address</h4>
                        <form class="needs-validation" action="{{ route('vnpay.payment') }}" method="POST">
                            <input type="number" name="amount"  required min="1000" step="1000" value="{{$totalCart}}" hidden>
                            <div class="row g-3">
                                <div class="col-sm-6"> <label for="firstName" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="" value="{{$info['name'] ?? ''}}" name="name"
                                        required="">
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-sm-6"> <label for="firstName" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="" value="{{$info['phone'] ?? ''}}" name="phone"
                                        required="">
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-12"> <label for="email" class="form-label">Email <span
                                            class="text-body-secondary">(Optional)</span></label> <input type="email"
                                        class="form-control" id="email" placeholder="you@example.com" value="{{$info['email'] ?? ''}}" name="email"> 
                                    <div class="invalid-feedback">
                                        Please enter a valid email address for shipping updates.
                                    </div>
                                </div>
                                <div class="col-12"> <label for="address" class="form-label">Address</label> 
                                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" value="{{$info['address'] ?? ''}}" name="address"
                                        required="">
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>
                               
                                
                                
                            </div>
                            
                            <hr class="my-4">
                            <h4 class="mb-3">Payment</h4>
                            <div class="my-3">
                                <div class="form-check"> <input id="credit" name="paymentMethod" type="radio"
                                        class="form-check-input" checked="" required=""> <label class="form-check-label"
                                        for="credit">Ngân Hàng Quốc Dân (NCB)</label> </div>
                                <div class="form-check"> <input id="debit" name="paymentMethod" type="radio"
                                        class="form-check-input" required=""> <label class="form-check-label"
                                        for="debit">Thanh toán khi nhận hàng</label> </div>
                            </div>
                            @if(!auth()->check())
                            <hr class="my-4">
                            <div class="form-check"> <input type="checkbox" class="form-check-input" id="save-info" name="save_info">
                                <label class="form-check-label" for="save-info">Save this information for next
                                    time</label> </div>
                                    @endif
                            <!-- <div class="row gy-3">
                                <div class="col-md-6"> <label for="cc-name" class="form-label">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                    <small class="text-body-secondary">Full name as displayed on card</small>
                                    <div class="invalid-feedback">
                                        Name on card is required
                                    </div>
                                </div>
                                <div class="col-md-6"> <label for="cc-number" class="form-label">Credit card
                                        number</label> <input type="text" class="form-control" id="cc-number"
                                        placeholder="" required="">
                                    <div class="invalid-feedback">
                                        Credit card number is required
                                    </div>
                                </div>
                                <div class="col-md-3"> <label for="cc-expiration" class="form-label">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" placeholder=""
                                        required="">
                                    <div class="invalid-feedback">
                                        Expiration date required
                                    </div>
                                </div>
                                <div class="col-md-3"> <label for="cc-cvv" class="form-label">CVV</label> <input
                                        type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                    <div class="invalid-feedback">
                                        Security code required
                                    </div>
                                </div>
                            </div> -->
                            <hr class="my-4"> <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to
                                checkout</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </section>

    <!-- end about section -->
@endsection