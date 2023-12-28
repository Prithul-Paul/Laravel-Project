@extends('front/layout')
@section('page_title','Checkout')
@section('container')
<section id="checkout">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="checkout-area">
            <form id="placeorder_form">
                @csrf
                <div class="row">
                <div class="col-md-8">
                    <div class="checkout-left">
                    <div class="panel-group" id="accordion">

                        @if(!session()->has('FRONT_CUSTOMER_ID'))
                            <!-- Login section -->
                            <div class="panel panel-default aa-checkout-login">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a  data-toggle="modal" data-target="#login-modal">
                                        Client Login 
                                    </a>
                                    </h4>
                                </div>
                            </div>
                        @endif

                        <!-- Billing Details -->
                        <div class="panel panel-default aa-checkout-billaddress">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                User Address Details
                            </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in">
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                    <input type="text" placeholder="Name*" name="customer_name" value="{{$customer['name']}}">
                                </div>                             
                                </div>
                                <div class="col-md-6">
                                    <div class="aa-checkout-single-bill">
                                        <input type="email" name="email" placeholder="Email Address*" value="{{$customer['email']}}">
                                    </div> 
                                    <span class="field_error" id="checkout_email"></span>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="aa-checkout-single-bill">
                                        <input type="tel" placeholder="Phone*" name="phome_number" value="{{$customer['mobile']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="aa-checkout-single-bill">
                                        <input type="text" placeholder="Company name" name="company_name" value="{{$customer['company']}}">
                                    </div>                             
                                </div>                            
                            </div>  
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="aa-checkout-single-bill">
                                        <input type="text" placeholder="State*" name="state" value="{{$customer['state']}}">
                                    </div>                      
                                </div>
                                <div class="col-md-6">
                                    <div class="aa-checkout-single-bill">
                                        <input type="text" placeholder="City / Town*" name="city_town" value="{{$customer['city']}}">
                                    </div>
                                </div>
                            </div>       
                            <div class="row">
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                    <input type="text" placeholder="Postcode / ZIP*" name="zip" value="{{$customer['zip']}}">
                                </div>
                                </div>
                            </div>                                    
                            </div>
                        </div>
                        </div>
                        <!-- Coupon section -->
                        <div class="panel panel-default aa-checkout-coupon">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Have a Coupon?
                            </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div id="coupon_fields">
                                    <input type="text" placeholder="Coupon Code" name="coupon_code" id="coupon_code" class="aa-coupon-code">
                                    <input type="button" value="Apply Coupon" id="apply_coupon" class="aa-browse-btn">
                                </div>
                                <div class="coupon_error" style="margin-top: 10px;font-size: 18px; color:rgb(238, 25, 25)"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                @if(isset($cart[0]))
                <div class="col-md-4">
                    <div class="checkout-right">
                    <h4>Order Summary</h4>
                    <div class="aa-order-summary-area">
                        <table class="table table-responsive">
                        <thead>
                            <tr>
                            <th>Product</th>
                            <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_price = 0;
                            @endphp
                            @foreach($cart as $item)
                            @php $total_price = $total_price + ($item->price * $item->qty); @endphp
                            <tr>
                            <td>{{$item->product_name}} <strong> x  {{$item->qty}}</strong></td>
                            <td>Rs. {{$item->price * $item->qty}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>Subtotal</th>
                            <td>Rs. {{$total_price}}</td>
                            </tr>
                            <tr id="coupon_applied">
                            </tr>
                            <tr>
                            <th>Total</th>
                            <td id="discounted_total" data-total="Rs. {{$total_price}}">Rs. {{$total_price}}</td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <h4>Payment Method</h4>
                    <div class="aa-payment-method">                    
                        <label for="cashdelivery"><input type="radio" id="cashdelivery" value="cod" name="payment_type" checked> Cash on Delivery </label>
                        <label for="paypal"><input type="radio" id="stripe" value="gateway" name="payment_type"> Via Stripe </label>
                        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark" style="margin-top: 2px;">    
                        <input type="submit" value="Place Order" id="placeorder_btn" class="aa-browse-btn">                
                    </div>
                    </div>
                </div>
                @endif
                </div>
            </form>
            <div id="place_order_msg" style="margin-top: 58px;text-align: center;color: red;font-size: 23px;margin: 59px 160px;
        "></div>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection