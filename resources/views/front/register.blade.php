@extends('front/layout')
@section('page_title','Registration')
@section('container')
<section id="aa-myaccount">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-myaccount-area">         
                    <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="aa-myaccount-register">                 
                        <h4>Register</h4>
                        <form action="" class="aa-login-form" id="registration_form">
                            @csrf
                            <div>
                                <label for="">Name<span>*</span></label>
                                <input type="text" name="customer_name" placeholder="Name">
                                <span id="customer_name" class="field_error"></span>
                            </div>
                            <div>
                                <label for="">Email address<span>*</span></label>
                                <input type="text" name="customer_email" placeholder="Email address">
                                <span id="customer_email" class="field_error"></span>
                            </div>
                            <div>
                                <label for="">Password<span>*</span></label>
                                <input type="password" name="customer_password" placeholder="Password">
                                <span id="customer_password" class="field_error"></span>
                            </div>
                            <div>
                                <label for="">Mobile<span>*</span></label>
                                <input type="number" name="customer_mobile" placeholder="Mobile">
                                <span id="customer_mobile" class="field_error"></span>
                            </div>
                            <button type="submit" class="aa-browse-btn" id="registration_form_btn">Register</button>                    
                        </form>
                        <span id="thankyoumsg" class="field_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    </div>          
                </div>
            </div>
        </div>
    </div>
</section>
@endsection