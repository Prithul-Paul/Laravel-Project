@extends('admin/layout')
@section('page_title','Manage Brand')
@section('brand_active_class','active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage brand</h2>
            <a href="{{url('/admin/brand')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body brand-form-wrapper">
                <form action="{{route('brand.process')}}" id="brand-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="brand" class="control-label mb-1">Brand</label>
                        <input id="brand" name="brand" value="{{$name}}" type="text" class="form-control">
                        @error('brand')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="brand_image" class="control-label mb-1">Brand Image</label>
                        <input id="brand_image" name="brand_image" type="file" class="form-control">
                        @error('brand_image')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="brand_id" value="{{$id}}">
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