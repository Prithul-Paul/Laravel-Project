@extends('admin/layout')
@section('page_title','Manage Category')
@section('category_active_class','active')

@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Manage Category</h2>
            <a href="{{url('/admin/category')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="fa fa-arrow-left"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('category.process')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category_name" class="control-label mb-1">Category Name</label>
                        <input id="category_name" name="category_name" value="{{$category_name}}" type="text" class="form-control">
                        @error('category_name')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    @if($category_id != "")
                    <div class="form-group">
                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                        <input id="category_slug" name="category_slug" value="{{$category_slug}}" type="text" class="form-control">
                        @error('category_slug')
                            <span style="color:#ff0000">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                        <select name="parent_category_id" id="parent_category_id" class="form-control">
                            <option value="0">Please select</option>
                            @foreach ($parent_category as $parent_cat)
                                <option value="{{$parent_cat->id}}" 
                                    @if($parent_category_id == $parent_cat->id)
                                        {{"SELECTED"}}
                                    @endif
                                >{{$parent_cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_image" class="control-label mb-1">Category Image</label>
                        <input id="category_image" name="category_image" type="file" class="form-control">
                        @if($category_image != "")
                            <img src="{{asset('/storage/media/category')}}/{{$category_image}}" width="100px">
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="checkbox" style="margin-left: 20px;">
                        <label for="is_homepage" class="form-check-label ">
                            <input type="checkbox" id="is_homepage" name="is_homepage" class="form-check-input" @if($is_homepage == 1){{"checked"}}@endif>Is Home Page
                        </label>
                        </div>
                    </div>
                    <input type="hidden" name="category_id" value="{{$category_id}}">
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