@extends('admin/layout')
@section('page_title','Customer')
@section('customer_active_class','active')
@section('container')

<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">customer</h2>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;    
                    ?>
                    @foreach ($result as $item)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->customer->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->mobile}}</td>
                            <td>
                                <a href="{{url('admin/pdf/download/'.$item->id)}}" class="btn btn-outline-success btn-sm">Download</a>
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