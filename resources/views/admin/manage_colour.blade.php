@extends('admin/layout')
@section('page_title','Manage Colour')
@section('colour_active_class','active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage colour</h2>
            <a href="{{url('/admin/colour')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('colour.process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="colour" class="control-label mb-1">Colour</label>
                        <input id="colour" name="colour" value="{{$colour}}" type="text" class="form-control">
                        @error('colour')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="colour_id" value="{{$colour_id}}">
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