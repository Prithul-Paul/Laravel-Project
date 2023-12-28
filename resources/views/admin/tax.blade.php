@extends('admin/layout')
@section('page_title','Tax')
@section('tax_active_class','active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">tax</h2>
            <a href="{{url('/admin/tax/manage_tax')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-plus"></i>add tax</a>
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
                        <th>Tax</th>
                        <th>Tax Value</th>
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
                            <td>{{$item->tax_name}}</td>
                            <td>{{$item->tax_value}}</td>
                            <td>
                                <a href="{{url('/admin/tax/manage_tax')}}/{{$item->id}}" class="btn btn-outline-success btn-sm">Edit</a>
                                @if($item->status == 0)
                                    @php
                                        $status = 1;
                                        $class = "success";
                                        $lable = "Activate";
                                    @endphp
                                @elseif($item->status == 1)
                                    @php
                                        $status = 0;
                                        $class = "danger";
                                        $lable = "Deactivate";
                                    @endphp
                                @endif
                                <a href="{{route('tax.status',['status' => $status, 'id' => $item->id])}}" class="btn btn-outline-{{$class}} btn-sm">{{$lable}}</a>

                                <button type="button" id="delete-tax" data-id="{{$item->id}}" data-url="{{route('tax.delete', $item->id)}}" class="btn btn-outline-danger btn-sm">Delete</button>
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