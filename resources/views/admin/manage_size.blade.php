@extends('admin/layout')
@section('page_title','Manage Size')
@section('size_active_class','active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage size</h2>
            <a href="{{url('/admin/size')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('size.process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="size" class="control-label mb-1">size</label>
                        <input id="size" name="size" value="{{$size}}" type="text" class="form-control">
                        @error('size')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="size_id" value="{{$size_id}}">
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