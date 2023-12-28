@extends('admin/layout')
@section('page_title','Coupon')
@section('coupon_active_class','active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">coupon</h2>
            <a href="{{url('/admin/coupon/manage_coupon')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-plus"></i>add coupon</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        @if(Session::has('msg'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('msg') }}
            </div>
        @endif
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Title</th>
                        <th>Code</th>
                        <th>Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;    
                    ?>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->code}}</td>
                            <td>
                                {{$item->value}}@if($item->type == "percentage"){{"%"}}@else{{"Rs. "}}@endif
                            </td>
                            <td>
                                <a href="{{url('/admin/coupon/manage_coupon')}}/{{$item->id}}" class="btn btn-outline-success btn-sm">Edit</a>
                                <button type="button" id="delete-coupon" data-id="{{$item->id}}" data-url="{{route('coupon.delete', $item->id)}}" class="btn btn-outline-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    <?php 
                    $i++;
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection