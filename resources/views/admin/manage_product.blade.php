@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_active_class','active')
@section('container')
@error('attr_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@enderror
@error('gallery_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@enderror
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Product</h2>
            <a href="{{url('/admin/product')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <form action="{{route('product.process')}}" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="product_name" class="control-label mb-1">Product Name</label>
                        <input id="product_name" name="product_name" value="{{$product_name}}" type="text" class="form-control">
                        @error('product_name')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    @if($id != "")
                    <div class="form-group">
                        <label for="slug" class="control-label mb-1">Product Slug</label>
                        <input id="slug" name="slug" value="{{$slug}}" type="text" class="form-control">
                        @error('slug')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="image" class="control-label mb-1">Product Image</label>
                        <input id="image" name="image" type="file" class="form-control">
                        @error('image')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                        @if(!empty($image))
                        <img src="{{asset('/storage/media/product/product_image')}}/{{$image}}" width="100px">
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="category" class="control-label mb-1">Category</label>
                                <select name="category" id="category" class="form-control">
                                        <option value="0">Please select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" 
                                            @if($category_id == $category->id)
                                                {{"SELECTED"}}
                                            @endif
                                        >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="brand" class="control-label mb-1">Brand</label>
                                <select name="brand" id="brand" class="form-control">
                                    <option value="0">Please select</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}" 
                                            @if($brand_id == $brand->id)
                                                {{"SELECTED"}}
                                            @endif
                                        >{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="model" class="control-label mb-1">Model</label>
                                <input id="model" name="model" value="{{$model}}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description" class="control-label mb-1">Description</label>
                                <textarea id="description" name="description" class="form-control editor">{{$description}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="short_description" class="control-label mb-1">Short Description</label>
                                <textarea id="short_description" name="short_description" class="form-control editor">{{$short_description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="keywords" class="control-label mb-1">Keywords</label>
                                <textarea id="keywords" name="keywords" class="form-control editor">{{$keywords}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="technical_specification" class="control-label mb-1">Technical Specification</label>
                                <textarea id="technical_specification" name="technical_specification" class="form-control editor">{{$technical_specification}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="uses" class="control-label mb-1">Uses</label>
                                <textarea id="uses" name="uses" class="form-control editor">{{$uses}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="warrenty" class="control-label mb-1">Warrenty</label>
                                <textarea id="warrenty" name="warrenty" class="form-control editor">{{$warrenty}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tax_id" class="control-label mb-1">Tax</label>
                                <select name="tax_id" id="tax_id" class="form-control">
                                    <option value="0">Please select</option>
                                    @foreach ($taxes as $tax)
                                        <option value="{{$tax->id}}" 
                                            @if($tax_id == $tax->id)
                                                {{"SELECTED"}}
                                            @endif
                                        >{{$tax->tax_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                <input id="lead_time" name="lead_time" value="{{$lead_time}}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                <select name="is_promo" id="is_promo" class="form-control">
                                    <option value="1" @if($is_promo == 1){{"SELECTED"}}@endif>Yes</option>
                                    <option value="0" @if($is_promo == 0){{"SELECTED"}}@endif>N0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                <select name="is_featured" id="is_featured" class="form-control">
                                    <option value="1" @if($is_featured == 1){{"SELECTED"}}@endif>Yes</option>
                                    <option value="0" @if($is_featured == 0){{"SELECTED"}}@endif>N0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="is_discount" class="control-label mb-1">Is Discount</label>
                                <select name="is_discount" id="is_discount" class="form-control">
                                    <option value="1" @if($is_discount == 1){{"SELECTED"}}@endif>Yes</option>
                                    <option value="0" @if($is_discount == 0){{"SELECTED"}}@endif>N0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="is_tranding" class="control-label mb-1">Is Tranding</label>
                                <select name="is_tranding" id="is_tranding" class="form-control">
                                    <option value="1" @if($is_tranding == 1){{"SELECTED"}}@endif>Yes</option>
                                    <option value="0" @if($is_tranding == 0){{"SELECTED"}}@endif>N0</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card attr-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Attribute</h2>
                                <button type="button" class="au-btn au-btn-icon au-btn--blue" id="add_more_attr">
                                    <i class="zmdi zmdi-plus"></i>Add Attribute</button type="button">
                            </div>
                        </div>
                    </div>

                    <div class="attr_card_wrapper" id="attr_card_wrapper">
                        <?php 
                            $i=1;
                            $product_attr_count = count($product_attr);
                        ?>
                        @foreach ($product_attr as $key=>$val)
                        <?php 
                            $attrArr = (array)$val;
                        ?>
                        <div class="m-t-30 attr_box" data-attr-box="{{$i}}" id="attr_box_{{$i}}">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="sku" class="control-label mb-1">SKU</label>
                                        <input id="sku" name="sku[]" value="{{$attrArr['sku']}}" type="text" class="form-control" required>
                                        @error('sku')
                                            <span style="color:#ff0000">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="mrp" class="control-label mb-1">MRP</label>
                                        <input id="mrp" name="mrp[]" value="{{$attrArr['mrp']}}" type="number" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="price" class="control-label mb-1">Price</label>
                                        <input id="price" name="price[]" value="{{$attrArr['price']}}" type="number" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="qty" class="control-label mb-1">Qty</label>
                                        <input id="qty" name="qty[]" value="{{$attrArr['qty']}}" type="number" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="size" class="control-label mb-1">Sizes</label>
                                        <select name="size[]" id="size" class="form-control">
                                                <option value="0">Please select</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{$size->id}}" 
                                                    @if($size->id == $attrArr['size_id'])
                                                        {{"SELECTED"}}
                                                    @endif
                                                >{{$size->size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="colors" class="control-label mb-1">Colors</label>
                                        <select name="colors[]" id="colors" class="form-control">
                                                <option value="0">Please select</option>
                                            @foreach ($colors as $color)
                                                <option value="{{$color->id}}" 
                                                    @if($color->id == $attrArr['color_id'])
                                                        {{"SELECTED"}}
                                                    @endif
                                                >{{$color->color}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="attr_image" class="control-label mb-1">Attribute Image</label>
                                        <input id="attr_image" name="attr_image[]" type="file" class="form-control">
                                        @if($attrArr['attr_image'] != "")
                                            <img src="{{asset('/storage/media/product/product_attr_image')}}/{{$attrArr['attr_image']}}" width="100px">
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" value="{{$attrArr['id']}}" name="product_attr_id[]">
                                @if($attrArr['sku'] != "" && $product_attr_count > 1)
                                <div class="col-lg-3 m-t-30">
                                    <a href="{{url('admin/product/delete_attribute')}}/{{$id}}/{{$attrArr['id']}}" class="btn btn-danger btn-sm" id="delete_attr">Delete</a>
                                </div>
                                @endif
                            </div>
                            <hr>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card gallery-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Gallery Image</h2>
                                <button type="button" class="au-btn au-btn-icon au-btn--blue" id="add_more_gallery">
                                    <i class="zmdi zmdi-plus"></i>Add Gallery</button type="button">
                            </div>
                        </div>
                    </div>
                    <div class="gallery_card_wrapper m-t-30 row" id="gallery_card_wrapper">
                        <?php 
                            $i=1;
                            $gallery_image_count = count($gallery_arr);
                        ?>
                        @foreach ($gallery_arr as $key=>$val)
                        <?php 
                            $galleryArr = (array)$val;
                        ?>
                        <div class="col-lg-6 m-t-30 gallery_box" data-gallery-box="{{$i}}" id="gallery_box_{{$i}}">
                            <div class="form-group">
                                <input name="gallery_image[]" type="file" class="form-control">
                            </div>
                            @if($galleryArr['image_name'] != "")
                                <img src="{{asset('/storage/media/product/product_gallery_image')}}/{{$galleryArr['image_name']}}" width="100px">
                            @endif
                            @if($gallery_image_count > 1)
                            <a href="{{url('admin/product/delete_gallery')}}/{{$id}}/{{$galleryArr['id']}}/{{$galleryArr['image_name']}}" type="button" style="float: right;margin-top: 18%;" class="btn btn-danger btn-sm" data-box="`+gallery_box_count+`" id="remove_gallery">Delete</a>
                            @endif
                            <input type="hidden" id="product_image_id" value="{{$galleryArr['id']}}" name="product_image_id[]">
                        </div>
                        <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="{{$id}}">
            <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                <span id="payment-button-amount">Submit</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection