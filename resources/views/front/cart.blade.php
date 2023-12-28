@extends('front/layout')
@section('page_title','Cart')
<?php 
// prx($cart);
?>
@section('container')
<!-- Cart view section -->
<section id="cart-view">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        @if(isset($cart[0]))
        <div class="cart-view-area">
        <div class="cart-view-table">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                            <tr data-product-id="{{$item->product_id}}" data-product-attr="{{$item->product_attr_id}}" data-price="{{$item->price}}">
                                <td><a class="remove" data-cart="{{$item->id}}" href="javascript:void(0);"><fa class="fa fa-close"></fa></a></td>
                                <td><a href="#"><img src="{{asset('/storage/media/product/product_attr_image')}}/{{$item->attr_image}}" alt="img"></a></td>
                                <td>
                                    <a class="aa-cart-title" href="#">{{$item->product_name}}</a>
                                    <div>
                                        <b>Size: </b>{{$item->size}}, 
                                        <b>Color: </b>{{$item->color}}
                                    </div>
                                </td>
                                <td>Rs. {{$item->price}}</td>
                                <td><input class="aa-cart-quantity cartpagequantity" type="number" value="{{$item->qty}}"></td>
                                <td class="updated_price_{{$item->product_id}}_{{$item->product_attr_id}}">Rs. {{$item->price * $item->qty}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            <!-- Cart Total view -->
            <div class="cart-view-total">
            @php
                $get_cart_detail = get_cart_detail();
                $totalprice = 0;
            @endphp
            @foreach($get_cart_detail as $cart_item)
                @php
                    $totalprice = $totalprice + ($cart_item->qty * $cart_item->price);
                @endphp
            @endforeach
            <h4>Cart Totals</h4>
            <table class="aa-totals-table">
                <tbody>
                <tr id="subtotal">
                    <th>Subtotal</th>
                    <td>Rs. {{$totalprice}}</td>
                </tr>
                <tr id="total">
                    <th>Total</th>
                    <td>Rs. {{$totalprice}}</td>
                </tr>
                </tbody>
            </table>
            <a href="{{url('/checkout')}}" class="aa-cart-view-btn">Proced to Checkout</a>
            </div>
        </div>
        </div>
        @else 
        <h2>Your Cart Is Empty.</h2>
        @endif
    </div>
    </div>
</div>
</section>
<!-- / Cart view section -->
<form id="update_cart_form">
    @csrf
    <input type="hidden" name="hidden_qty" id="hidden_qty">
    <input type="hidden" name="hidden_product_id" id="hidden_product_id">
    <input type="hidden" name="hidden_product_attr_id" id="hidden_product_attr_id">
    <input type="hidden" name="hidden_price" id="hidden_price">
    <input type="hidden" name="hidden_cart_id" id="hidden_cart_id">
</form>
@endsection