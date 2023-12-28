@extends('front/layout')
@section('page_title',$product[0]->product_name)
@section('container')
<!-- product category -->
<section id="aa-product-details">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="aa-product-details-area">
            <div class="aa-product-details-content">
            <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                    <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('storage/media/product/product_image/'.$product[0]->image)}}" class="simpleLens-lens-image"><img src="{{asset('storage/media/product/product_image/'.$product[0]->image)}}" class="simpleLens-big-image"></a></div>
                    </div>
                    <div class="simpleLens-thumbnails-container">
                        <a data-big-image="{{asset('storage/media/product/product_image/'.$product[0]->image)}}" data-lens-image="{{asset('storage/media/product/product_image/'.$product[0]->image)}}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{asset('storage/media/product/product_image/'.$product[0]->image)}}" width="100px">
                        </a>
                        @if(isset($product_image[0]))
                            @foreach ($product_image as $item)
                                <a data-big-image="{{asset('storage/media/product/product_gallery_image/'.$item->image_name)}}" data-lens-image="{{asset('storage/media/product/product_gallery_image/'.$item->image_name)}}" class="simpleLens-thumbnail-wrapper" href="#">
                                    <img src="{{asset('storage/media/product/product_gallery_image/'.$item->image_name)}}" width="100px">
                                </a>
                            @endforeach
                        @endif                                
                    </div>
                    </div>
                </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="aa-product-view-content">
                    <h3>{{$product[0]->product_name}}</h3>
                    <div class="aa-price-block">
                        <span class="aa-product-price">Rs. {{$product_attr[$product[0]->id][0]->price}}</span><span class="aa-product-price"><del>Rs. {{$product_attr[$product[0]->id][0]->mrp}}</del></span>
                    <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                    </div>
                    {!!$product[0]->short_description!!}
                    <h4>Size</h4>
                    <div class="aa-prod-view-size">
                    @php
                        $sizearr = array();
                        foreach($product_attr[$product[0]->id] as $attr)
                        {
                            $sizearr[] = $attr->size;
                        }
                        $sizearr = array_unique($sizearr);
                        // echo "<pre>"; print_r($sizearr); echo "</pre>"; die();
                    @endphp
                    @foreach($sizearr as $size)
                        <a href="javascript:void(0);">{{$size}}</a>
                    @endforeach
                    </div>
                    <h4>Color</h4>
                    <div class="aa-color-tag">
                    @foreach($product_attr[$product[0]->id] as $attr)
                    @if($attr->color!="")
                        <a href="javascript:void(0);" class="product_color size_{{$attr->size}} aa-color-{{strtolower($attr->color)}}" data-color="{{($attr->color)}}" data-image="{{asset('storage/media/product/product_attr_image/'.$attr->attr_image)}}"></a>
                    @endif
                    @endforeach                   
                    </div>
                    <div class="aa-prod-quantity">
                    <form action="">
                        <select id="qty" name="">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        </select>
                    </form>
                    <p class="aa-prod-category">
                        Model: <a href="#">{{$product[0]->model}}</a>
                    </p>
                    </div>
                    <form id="add_to_cart_form">
                        @csrf
                        <input type="hidden" name="hidden_size" id="hidden_size">
                        <input type="hidden" name="hidden_color" id="hidden_color">
                        <input type="hidden" name="hidden_qty" id="hidden_qty">
                        <input type="hidden" name="product_id" value="{{$product[0]->id}}">
                        <div class="aa-prod-view-bottom">
                            <button class="aa-add-to-cart-btn" type="button" id="add-to-cart">Add To Cart</button>
                            <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                        </div>
                    </form>
                    <div class="error-notification" style="margin-top: 10px; color: red;"></div>
                </div>
                </div>
            </div>
            </div>
            <div class="aa-product-details-bottom">
            <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>
                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                <li><a href="#warrenty" data-toggle="tab">Warrenty</a></li>
                <li><a href="#review" data-toggle="tab">Review</a></li>
                              
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                {!!$product[0]->description!!}
                </div>
                <div class="tab-pane fade" id="technical_specification">
                    {!!$product[0]->technical_specification!!}
                </div>
                <div class="tab-pane fade" id="uses">
                    {!!$product[0]->uses!!}
                </div>
                <div class="tab-pane fade" id="warrenty">
                    {!!$product[0]->warrenty!!}
                </div>
                <div class="tab-pane fade " id="review">
                <div class="aa-product-review-area">
                <h4>2 Reviews for T-Shirt</h4> 
                <ul class="aa-review-nav">
                    <li>
                        <div class="media">
                        <div class="media-left">
                            <a href="#">
                            <img class="media-object" src="{{asset('front-assets/img/testimonial-img-3.jpg')}}" alt="girl image">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        </div>
                    </li>
                    <li>
                        <div class="media">
                        <div class="media-left">
                            <a href="#">
                            <img class="media-object" src="{{asset('front-assets/img/testimonial-img-3.jpg')}}" alt="girl image">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        </div>
                    </li>
                </ul>
                <h4>Add a review</h4>
                <div class="aa-your-rating">
                    <p>Your Rating</p>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                    <a href="#"><span class="fa fa-star-o"></span></a>
                </div>
                <!-- review form -->
                <form action="" class="aa-review-form">
                    <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                    </div>  
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                    </div>

                    <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                </form>
                </div>
                </div>            
            </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
            <h3>Related Products</h3>
            <ul class="aa-product-catg aa-related-item-slider">
                <!-- start single product item -->
                @foreach($related_product as $product)
                <li>
                    <figure>
                    <a class="aa-product-img" href="{{url('product/'.$product->slug)}}"><img src="{{asset('storage/media/product/product_image/'.$product->image)}}" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                        <h4 class="aa-product-title"><a href="{{url('product/'.$product->slug)}}">{{$product->product_name}}</a></h4>
                        <span class="aa-product-price">Rs. {{$related_product_attr[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs. {{$related_product_attr[$product->id][0]->mrp}}</del></span>
                    </figcaption>
                    </figure>                        
                    <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                          
                    </div>
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
@endsection