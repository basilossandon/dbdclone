@extends('layouts.app')
@section('title', 'Payment')

@section('content')

{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

<div class="login-form-container">
   <div class="col-md-6 offset-md-3">
        <span class="anchor" id="formPayment"></span>
        <hr class="my-5">
        <div class="card card-outline-secondary">
            <div class="card-body">
                <h3 class="text-center">Credit Card Payment</h3>
                <hr>
                <form class="form" role="form" autocomplete="off" action="/reserve/store_payment" method="POST">
                    <div class="form-group">
                        <label for="cc_name">Card Holder's Name</label>
                        <input name="cc_owner" type="text" class="form-control" id="cc_name" pattern="\w+ \w+.*" title="First and last name" required="required">
                    </div>
                    <div class="form-group">
                        <label><br>Card Number</label>
                        <img class="img-responsive" align="right" src="http://i76.imgup.net/accepted_c22e0.png">

                        <input name="cc_number" type="text" class="form-control right" autocomplete="off" maxlength="20" pattern="\d{16}" title="Credit card number" required="">

                    </div>
                    <div class="form-group row">
                        <label class="col-md-12">Card Exp. Date</label>
                        <div class="col-md-4">
                            <select class="form-control" style="background: #242A48;border-radius: 5px;" name="cc_exp_mo" size="0">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" style="background: #242A48;border-radius: 5px;" name="cc_exp_yr" size="0">
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input name="cc_security_code" type="text" class="form-control" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required="" placeholder="CVC">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-12">Amount</label>
                    </div>
                    <div class="form-inline">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text" style="color:white"><h2>$</h2></span></div>
                            <input disabled="disabled" type="text" style="border-radius: 5px;" class="form-control text-right" id="exampleInputAmount" placeholder="{{$total}}">
                            <div class="input-group-append"><span class="input-group-text" style="color:white">.00</span></div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="reset" style="color:white;" class="btn btn-danger rbtn-lg btn-block">Cancel</button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>                  

                    <!-- /form card cc payment -->
                
@endsection
