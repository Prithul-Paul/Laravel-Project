@extends('front/layout')
@section('page_title','sdf')
@section('container')
<!-- catg header banner section -->
{{-- <section id="aa-catg-head-banner">
<img src="{{asset('storage/media/category/'.$category[0]->category_image)}}" alt="fashion img">
<div class="aa-catg-head-banner-area">
    <div class="container">
    <div class="aa-catg-head-banner-content">
        <h2>{{$category[0]->name}}</h2>
        <ol class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a></li>         
        <li class="active">{{$category[0]->name}}</li>
        </ol>
    </div>
    </div>
</div>
</section> --}}
<!-- / catg header banner section -->

<!-- product category -->
<section id="aa-product-category">
    <div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
        <div class="aa-product-catg-content">
            <div class="aa-product-catg-body">
            <ul class="aa-product-catg">
                    @foreach($product as $product)
                    <li>
                        <figure>
                        <a class="aa-product-img" href="{{url('product/'.$product->slug)}}"><img src="{{asset('storage/media/product/product_image/'.$product->image)}}" alt="polo shirt img"></a>
                        <button class="aa-add-card-btn home-add-to-cart" data-productid="{{$product->id}}" data-color="{{$product_attr[$product->id][0]->color}}" data-size="{{$product_attr[$product->id][0]->size}}"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="{{url('product/'.$product->slug)}}">{{$product->product_name}}</a></h4>
                            <span class="aa-product-price">Rs. {{$product_attr[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs. {{$product_attr[$product->id][0]->mrp}}</del></span>
                        </figcaption>
                        </figure>                        
                    </li> 
                @endforeach 
            </ul>
            
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
<!-- / product category -->
<form id="add_to_cart_form">
    @csrf
    <input type="hidden" name="hidden_size" id="hidden_size">
    <input type="hidden" name="hidden_color" id="hidden_color">
    <input type="hidden" name="hidden_qty" id="hidden_qty" value="1">
    <input type="hidden" name="product_id" id="product_id">
</form>

@endsection