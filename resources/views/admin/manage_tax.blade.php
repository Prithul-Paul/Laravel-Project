@extends('admin/layout')
@section('page_title','Manage Tax')
@section('tax_active_class','active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage tax</h2>
            <a href="{{url('/admin/tax')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('tax.process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="tax_name" class="control-label mb-1">Tax Name</label>
                        <input id="tax_name" name="tax_name" value="{{$tax_name}}" type="text" class="form-control">
                        @error('tax_name')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tax_value" class="control-label mb-1">Tax Value</label>
                        <input id="tax_value" name="tax_value" value="{{$tax_value}}" type="text" class="form-control">
                        @error('tax_value')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="tax_id" value="{{$tax_id}}">
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