@extends('admin/layout')
@section('page_title','Manage Coupon')
@section('coupon_active_class','active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Coupon</h2>
            <a href="{{url('/admin/coupon')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('coupon.process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="control-label mb-1">Title</label>
                        <input id="title" name="title" value="{{$title}}" type="text" class="form-control">
                        @error('title')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="code" class="control-label mb-1">Coupon Code</label>
                        <input id="code" name="code" value="{{$code}}" type="text" class="form-control">
                        @error('code')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="value" class="control-label mb-1">Coupon Value</label>
                        <input id="value" name="value" value="{{$value}}" type="text" class="form-control">
                        @error('value')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="type" class="control-label mb-1">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="percentage" @if($type == "percentage"){{"SELECTED"}}@endif>Percentage</option>
                                    <option value="value" @if($type == "value"){{"SELECTED"}}@endif>Value</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="min_order_amt" class="control-label mb-1">Minimum Order At</label>
                                <input id="min_order_amt" name="min_order_amt" value="{{$min_order_amt}}" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="is_onetime" class="control-label mb-1">Is Onetime</label>
                                <select name="is_onetime" id="is_onetime" class="form-control">
                                    <option value="1" @if($is_onetime == 1){{"SELECTED"}}@endif>Yes</option>
                                    <option value="0" @if($is_onetime == 0){{"SELECTED"}}@endif>No</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="coupon_id" value="{{$coupon_id}}">
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