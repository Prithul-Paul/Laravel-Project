@extends('front/layout')
@section('page_title','Reset Your Password')
@section('container')
<section id="aa-myaccount">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-myaccount-area">         
                    <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        @if($expiry == "not_expired")
                        <div class="aa-myaccount-register">                 
                        <h4>Reset Your Password</h4>
                        <form action="" class="aa-login-form" id="reset_password_form">
                            @csrf
                            <div>
                                <label for="">Password<span>*</span></label>
                                <input type="password" id="reset_password" name="password" placeholder="Password">
                                <span id="password" class="field_error"></span>
                            </div>
                            <div>
                                <label for="">Confirm Password<span>*</span></label>
                                <input type="password" id="reset_confirm_password" name="confirm_password" placeholder="Confirm Password">
                                <span id="confirm_password" class="field_error"></span>
                            </div>
                            <input type="hidden" value="{{$customer_id}}" name="customer_id">
                            <button type="submit" class="aa-browse-btn" id="registration_form_btn">Submit</button>                    
                        </form>
                        <span id="thankyoumsg" class="field_error"></span>
                        </div>
                        @elseif($expiry == "expired")
                        <h2>This is page is expired.</h2>
                        @endif
                    </div>
                    <div class="col-md-3"></div>
                    </div>          
                </div>
            </div>
        </div>
    </div>
</section>
@endsection