@extends('front/layout')
@section('page_title','Home')
@section('container')
<!-- Start slider -->
<section id="aa-slider">
<div class="aa-slider-area">
    <div id="sequence" class="seq">
    <div class="seq-screen">
        <ul class="seq-canvas">
        <!-- single slide item -->
        @foreach($banners as $banner)
            <li>
                <div class="seq-model">
                <img data-seq src="{{asset('storage/media/banner/'.$banner->banner_image)}}" alt="Men slide img" />
                </div>
                <div class="seq-title">
                <span data-seq>{{$banner->offer_txt}}</span>
                <h2 data-seq>{{$banner->main_heading}}</h2>
                <p data-seq>{{$banner->short_content}}</p>
                @if(!empty($banner->link_txt) && !empty($banner->url))
                <a data-seq href="{{$banner->url}}" class="aa-shop-now-btn aa-secondary-btn">{{$banner->link_txt}}</a>
                @endif
                </div>
            </li>
        @endforeach                  
        </ul>
    </div>
    <!-- slider navigation btn -->
    <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
        <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
        <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
    </fieldset>
    </div>
</div>
</section>
<!-- / slider -->
<!-- Start Promo section -->
<section id="aa-promo">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="aa-promo-area">
        <div class="row">
    
            <div class="col-md-12 no-padding">
            <div class="aa-promo-right">
                @foreach($home_categories as $home_category)
                <div class="aa-single-promo-right">
                <div class="aa-promo-banner"> 
                    @if(!empty($home_category->category_image))                     
                    <img src="{{asset('storage/media/category/'.$home_category->category_image)}}" alt="img">   
                    @endif                   
                    <div class="aa-prom-content">
                    <span>Exclusive Item</span>
                    <h4><a href="{{url('category/'.$home_category->slug)}}">For {{$home_category->name}}</a></h4>                        
                    </div>
                </div>
                </div>
                @endforeach
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</section>
<!-- / Promo section -->
<!-- Products section -->
<section id="aa-product">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="row">
        <div class="aa-product-area">
            <div class="aa-product-inner">
            <!-- start prduct navigation -->
                <ul class="nav nav-tabs aa-products-tab">
                @php $i = 1; @endphp
                @foreach($home_categories as $home_category)
                    <li class="@if($i == 1){{"active"}}@endif "><a href="#{{$home_category->slug}}" data-toggle="tab">{{$home_category->name}}</a></li>
                @php $i++; @endphp
                @endforeach
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                <!-- Start men product category -->
                @php $i = 1; @endphp
                @foreach($home_categories as $home_category)
                    <div class="tab-pane fade @if($i == 1){{"in active"}}@endif" id="{{$home_category->slug}}">
                        @if(isset($home_categories_product[$home_category->id][0]))
                        <ul class="aa-product-catg">
                            @foreach($home_categories_product[$home_category->id] as $product)
                            <li>
                                <figure>
                                <a class="aa-product-img" href="{{url('product/'.$product->slug)}}"><img src="{{asset('storage/media/product/product_image/'.$product->image)}}" alt="polo shirt img"></a>
                                <button class="aa-add-card-btn home-add-to-cart" data-productid="{{$product->id}}" data-color="{{$product_attr[$product->id][0]->color}}" data-size="{{$product_attr[$product->id][0]->size}}"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                                    <figcaption>
                                    <h4 class="aa-product-title"><a href="{{url('product/'.$product->slug)}}">{{$product->product_name}}</a></h4>
                                    <span class="aa-product-price">Rs. {{$product_attr[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs. {{$product_attr[$product->id][0]->mrp}}</del></span>
                                </figcaption>
                                </figure>                        
                                <div class="aa-product-hvr-content">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                          
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                            <div>No Product Found!</div>
                        @endif

                    </div>
                @php $i++; @endphp
                @endforeach
                </div>
                <!-- / electronic product category -->

                </div>
                <!-- quick view modal -->                  
                <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                            <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                                <div class="simpleLens-container">
                                    <div class="simpleLens-big-image-container">
                                        <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png')}}">
                                            <img src="{{asset('front-assets/img/view-slider/medium/polo-shirt-1.png')}}" class="simpleLens-big-image">
                                        </a>
                                    </div>
                                </div>
                                <div class="simpleLens-thumbnails-container">
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                        data-lens-image="img/view-slider/large/polo-shirt-1.png')}}"
                                        data-big-image="img/view-slider/medium/polo-shirt-1.png')}}">
                                        <img src="{{asset('front-assets/img/view-slider/thumbnail/polo-shirt-1.png')}}">
                                    </a>                                    
                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                        data-lens-image="img/view-slider/large/polo-shirt-3.png')}}"
                                        data-big-image="img/view-slider/medium/polo-shirt-3.png')}}">
                                        <img src="{{asset('front-assets/img/view-slider/thumbnail/polo-shirt-3.png')}}">
                                    </a>

                                    <a href="#" class="simpleLens-thumbnail-wrapper"
                                        data-lens-image="img/view-slider/large/polo-shirt-4.png')}}"
                                        data-big-image="img/view-slider/medium/polo-shirt-4.png')}}">
                                        <img src="{{asset('front-assets/img/view-slider/thumbnail/polo-shirt-4.png')}}">
                                    </a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- Modal view content -->
                        </div>
                    </div>                        
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                </div><!-- / quick view modal -->              
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</section>
<!-- / Products section -->

<!-- popular section -->
<section id="aa-popular-category">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="row">
        <div class="aa-popular-category-area">
            <!-- start prduct navigation -->
            <ul class="nav nav-tabs aa-products-tab">
            <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
            <li><a href="#tranding" data-toggle="tab">Tranding</a></li>
            <li><a href="#discounted" data-toggle="tab">Discounted</a></li>                    
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
            <!-- Start men featured category -->
            <div class="tab-pane fade in active" id="featured">
                <ul class="aa-product-catg aa-featured-slider">
                    @foreach($home_featured_product as $featured_product)
                    <li>
                        <figure>
                        <a class="aa-product-img" href="{{url('product/'.$featured_product->slug)}}"><img src="{{asset('storage/media/product/product_image/'.$featured_product->image)}}" alt="polo shirt img"></a>
                        <button class="aa-add-card-btn home-add-to-cart" data-productid="{{$featured_product->id}}" data-color="{{$featured_product_attr[$featured_product->id][0]->color}}" data-size="{{$featured_product_attr[$featured_product->id][0]->size}}"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="{{url('product/'.$featured_product->slug)}}">{{$featured_product->product_name}}</a></h4>
                            <span class="aa-product-price">Rs. {{$featured_product_attr[$featured_product->id][0]->price}}</span><span class="aa-product-price"><del>Rs. {{$featured_product_attr[$featured_product->id][0]->mrp}}</del></span>
                        </figcaption>
                        </figure>                        
                        <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                          
                        </div>
                    </li> 
                    @endforeach                                                                      
                </ul>
                <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
            </div>
            <!-- / popular product category -->
            
            <!-- start tranding product category -->
            <div class="tab-pane fade" id="tranding">
                <ul class="aa-product-catg aa-tranding-slider">
                    @foreach($home_tranding_product as $tranding_product)
                    <li>
                        <figure>
                        <a class="aa-product-img" href="{{url('product/'.$tranding_product->slug)}}"><img src="{{asset('storage/media/product/product_image/'.$tranding_product->image)}}" alt="polo shirt img"></a>
                        <button class="aa-add-card-btn home-add-to-cart" data-productid="{{$tranding_product->id}}" data-color="{{$tranding_product_attr[$tranding_product->id][0]->color}}" data-size="{{$tranding_product_attr[$tranding_product->id][0]->size}}"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="{{url('product/'.$tranding_product->slug)}}">{{$tranding_product->product_name}}</a></h4>
                            <span class="aa-product-price">Rs. {{$tranding_product_attr[$tranding_product->id][0]->price}}</span><span class="aa-product-price"><del>Rs. {{$tranding_product_attr[$tranding_product->id][0]->mrp}}</del></span>
                        </figcaption>
                        </figure>                        
                        <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                          
                        </div>
                    </li> 
                    @endforeach                                                                                   
                </ul>
                <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
            </div>
            <!-- / featured product category -->

            <!-- start discounted product category -->
            <div class="tab-pane fade" id="discounted">
                <ul class="aa-product-catg aa-discounted-slider">
                    @foreach($home_discounted_product as $discounted_product)
                    <li>
                        <figure>
                        <a class="aa-product-img" href="{{url('product/'.$discounted_product->slug)}}"><img src="{{asset('storage/media/product/product_image/'.$discounted_product->image)}}" alt="polo shirt img"></a>
                        <button class="aa-add-card-btn home-add-to-cart" data-productid="{{$discounted_product->id}}" data-color="{{$discounted_product_attr[$discounted_product->id][0]->color}}" data-size="{{$discounted_product_attr[$discounted_product->id][0]->size}}"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="{{url('product/'.$discounted_product->slug)}}">{{$discounted_product->product_name}}</a></h4>
                            <span class="aa-product-price">Rs. {{$discounted_product_attr[$discounted_product->id][0]->price}}</span><span class="aa-product-price"><del>Rs. {{$discounted_product_attr[$discounted_product->id][0]->mrp}}</del></span>
                        </figcaption>
                        </figure>                        
                        <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                          
                        </div>
                    </li> 
                    @endforeach                                                                                   
                </ul>
                <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
            </div>
            <!-- / latest product category -->              
            </div>
        </div>
        </div> 
    </div>
    </div>
</div>
</section>
<!-- / popular section -->
<!-- Support section -->
<section id="aa-support">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="aa-support-area">
        <!-- single support -->
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
            <span class="fa fa-truck"></span>
            <h4>FREE SHIPPING</h4>
            <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
            </div>
        </div>
        <!-- single support -->
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
            <span class="fa fa-clock-o"></span>
            <h4>30 DAYS MONEY BACK</h4>
            <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
            </div>
        </div>
        <!-- single support -->
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
            <span class="fa fa-phone"></span>
            <h4>SUPPORT 24/7</h4>
            <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</section>
<!-- / Support section -->
<!-- Client Brand -->
<section id="aa-client-brand">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="aa-client-brand-area">
        <ul class="aa-client-brand-slider">
            @foreach($home_brand as $brand)
                <li><a href="#"><img src="{{asset('storage/media/brand/'.$brand->image)}}" alt="java img"></a></li>
            @endforeach
        </ul>
        </div>
    </div>
    </div>
</div>
</section>
<form id="add_to_cart_form">
    @csrf
    <input type="hidden" name="hidden_size" id="hidden_size">
    <input type="hidden" name="hidden_color" id="hidden_color">
    <input type="hidden" name="hidden_qty" id="hidden_qty" value="1">
    <input type="hidden" name="product_id" id="product_id">
</form>
@endsection