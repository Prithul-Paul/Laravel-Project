@extends('admin/layout')
@section('page_title','Manage Banner')
@section('banner_active_class','active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage banner</h2>
            <a href="{{url('/admin/banner')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('banner.process')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="banner_image" class="control-label mb-1">Banner Image</label>
                        <input id="banner_image" name="banner_image" type="file" class="form-control">
                        @error('banner_image')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                        @if(!empty($banner_image))
                        <img src="{{asset('/storage/media/banner')}}/{{$banner_image}}" width="200px">
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="offer_text" class="control-label mb-1">Offer Text</label>
                                <input id="offer_text" name="offer_text" value="{{$offer_txt}}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="main_heading" class="control-label mb-1">Main Heading</label>
                                <input id="main_heading" name="main_heading" value="{{$main_heading}}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="short_description" class="control-label mb-1">Short Description</label>
                                <input id="short_description" name="short_description" value="{{$short_content}}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="banner_link_text" class="control-label mb-1">Banner Link Text</label>
                        <input id="banner_link_text" name="banner_link_text" value="{{$link_txt}}" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="banner_link" class="control-label mb-1">Banner Link</label>
                        <input id="banner_link" name="banner_link" value="{{$url}}" type="text" class="form-control">
                        @error('banner_link')
                            <span style="color:#ff0000">{{ "Please Enter Valid URL" }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="banner_id" value="{{$id}}">
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection