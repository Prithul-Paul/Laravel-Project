@extends('front/layout')
@section('page_title',$category[0]->name)
@section('container')
<!-- catg header banner section -->
<section id="aa-catg-head-banner">
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
</section>
<!-- / catg header banner section -->

<!-- product category -->
<section id="aa-product-category">
    <div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
        <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
            <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                <label for="">Sort by</label>
                <select name="" id="sort_by">
                    <option value="" selected="Default">Default</option>
                    <option value="name">Name</option>
                    <option value="price_desc">Price-DESC</option>
                    <option value="price_asc">Price-ASC</option>
                    <option value="date">Date</option>
                </select>
                </form>
            </div>
            <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
            </div>
            </div>
            <div class="aa-product-catg-body">
            <ul class="aa-product-catg">
                    @foreach($category_product as $product)
                    <li>
                        <figure>
                        <a class="aa-product-img" href="{{url('product/'.$product->slug)}}"><img src="{{asset('storage/media/product/product_image/'.$product->image)}}" alt="polo shirt img"></a>
                        <button class="aa-add-card-btn home-add-to-cart" data-productid="{{$product->id}}" data-color="{{$category_product_attr[$product->id][0]->color}}" data-size="{{$category_product_attr[$product->id][0]->size}}"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="{{url('product/'.$product->slug)}}">{{$product->product_name}}</a></h4>
                            <span class="aa-product-price">Rs. {{$category_product_attr[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs. {{$category_product_attr[$product->id][0]->mrp}}</del></span>
                        </figcaption>
                        </figure>                        
                    </li> 
                @endforeach 
            </ul>
            
            </div>
        </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
        <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
            <h3>Category</h3>
            <ul class="aa-catg-nav">
                @foreach($left_categories as $left_category)
                    <li><a href="{{url('category/'.$left_category->slug)}}">{{$left_category->name}}</a></li>
                @endforeach
                {{-- <li><a href="">Women</a></li>
                <li><a href="">Kids</a></li>
                <li><a href="">Electornics</a></li>
                <li><a href="">Sports</a></li> --}}
            </ul>
            </div>
            <div class="aa-sidebar-widget">
            {{-- <h3>Shop By Price</h3>              
            <!-- price range -->
            <div class="aa-sidebar-price-range">
            <form action="">
                <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                </div>
                @php
                    $lowest_price = count($price_range)-1;
                @endphp
                <span id="skip-value-lower" data-price="{{$price_range[$lowest_price]->price}}" class="example-val">30.00</span>
                <span id="skip-value-upper" data-price="{{$price_range[0]->price}}" class="example-val">100.00</span>
                <button class="aa-filter-btn" id="price_filter_button" type="button">Filter</button>
            </form>
            </div>               --}}

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
            <h3>Shop By Color</h3>
            <div class="aa-color-tag">
                @foreach($colors as $color)
                    @if(in_array($color->id, $color_filter_arr))
                        <a class="aa-color-{{strtolower($color->color)}}"></a>
                    @else
                         <a class="aa-color-{{strtolower($color->color)}}" data-color-id={{$color->id}} id="color_code" href="javascript:void(0);"></a>
                    @endif
                @endforeach
                {{-- <a class="aa-color-yellow" href="#"></a>
                <a class="aa-color-pink" href="#"></a>
                <a class="aa-color-purple" href="#"></a>
                <a class="aa-color-blue" href="#"></a>
                <a class="aa-color-orange" href="#"></a>
                <a class="aa-color-gray" href="#"></a>
                <a class="aa-color-black" href="#"></a>
                <a class="aa-color-white" href="#"></a>
                <a class="aa-color-cyan" href="#"></a>
                <a class="aa-color-olive" href="#"></a>
                <a class="aa-color-orchid" href="#"></a> --}}
            </div>                            
            </div>
        </aside>
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
<form id="product_filter">
    <input type="hidden" name="sort_type" id="sort_type">
    {{-- <input type="hidden" name="price_range_start" id="price_range_start">
    <input type="hidden" name="price_range_end" id="price_range_end"> --}}
    <input type="hidden" name="color_filter" id="color_filter" value="{{$color_id}}">
</form>
@endsection