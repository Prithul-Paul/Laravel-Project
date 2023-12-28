@extends('admin/layout')
@section('page_title','Banner')
@section('banner_active_class','active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">banner</h2>
            <a href="{{url('/admin/banner/manage_banner')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-plus"></i>add banner</a>
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
                        <th>Banner Image</th>
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
                            <td>
                                @if(!empty($item->banner_image))
                                <img src="{{asset('/storage/media/banner')}}/{{$item->banner_image}}" width="200px">
                                @endif
                            </td>
                            <td>
                                <a href="{{url('/admin/banner/manage_banner')}}/{{$item->id}}" class="btn btn-outline-success btn-sm">Edit</a>
                                <button type="button" id="delete-banner" data-id="{{$item->id}}" data-url="{{route('banner.delete', $item->id)}}" class="btn btn-outline-danger btn-sm">Delete</button>
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