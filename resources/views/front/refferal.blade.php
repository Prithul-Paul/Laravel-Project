@extends('front/layout')
@section('page_title','Reffer A Friend')
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
                        <h4>Enter The Email ID</h4>
                        <form action="{{route('reffer_friend_process')}}" class="aa-login-form" id="reffer_form" method="POST">
                            @csrf
                            <div>
                                <label for="">Email address<span>*</span></label>
                                <input type="text" name="reffer_email" placeholder="Email address">
                                <span id="reffer_email" class="field_error"></span>
                            </div>
                            <button type="submit" class="aa-browse-btn" id="registration_form_btn">Send</button>                    
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