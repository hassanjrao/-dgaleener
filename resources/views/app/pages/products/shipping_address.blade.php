@extends('layouts.application')
@section('page-title')
    {{'ANEW - Anew Avenue Biomagnestim Magnets'}}
@stop
@section('styles')
    @parent

    <link href="{{ asset('css/app/products.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => ''])
    <div class="row products-body">
        <div class="col-12 prduct-text" style="padding:30px 20%" >
            <h1 class="text-center">Shipping info</h2>
            <form id="shippingaddressform" action="/products/checkout"  method="POST" >
                @csrf
                <input type="hidden" id="media_id" name="id" value="" />
                <div class="form-group">
                    <label for="shipping_address">Shipping address:</label>
                    <input required type="text" autocomplete="nope" class="form-control" id="shipping_address" name="shipping_address">
                </div>
                <div class="row">
                    <div class="col-6" style="padding-left:0;" >
                        <div class="form-group">
                            <label for="shipping_zip">Shipping zip:</label>
                            <input  type="number" required autocomplete="nope" class="form-control" id="shipping_zip" name="shipping_zip">
                        </div>
                    </div>
                    <div class="col-6" style="padding-right:0;">
                        <div class="form-group">
                            <label for="shipping_day_set">Delivery day:</label>
                            <select required name="shipping_day_set" id="shipping_day_set" style="width:100%;display:block;height: 38px;border-radius: 4px;border-color: #ccc;" >
                                <option value="1">1-3 Days</option>
                                <option value="2">1 Day</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="shipping_rate">Shipping rate:</label>
                    <input type="text" required autocomplete="nope" readonly class="form-control" id="shipping_rate" name="shipping_rate">
                </div>
				<input class="pull-right" type="submit" value="Next"  />            
            
            </form>
            
        </div>
    </div>
@endsection
@section('javascripts')
    @parent

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script> 
        $("input[type='number']#shipping_zip").bind("input", function() {
            if($(this).val().length >= 5){
                var formData = $('#shippingaddressform').serializeArray();
                $.ajax({
                    url: "{{ URL::route('app.products.usps') }}",
                    type: "POST",
                    data: formData,
                    success: function (msg) {
                        if(msg != 'usps limit over'){
                            if(msg.Package.Error){
                                $('#shipping_rate').val('');
                                swal({
                                    title: msg.Package.Error.Description,
                                    icon: "error",
                                    closeOnClickOutside: false});

                            }else{
                                $('#shipping_rate').val(msg.Package.Postage.Rate);
                            }
                        }else{
                            swal({
                                title: "USPS limit over. Your product should be less then 70lbs",
                                icon: "error",
                                closeOnClickOutside: false});
                        }

                    }
                }); 
            }else if($(this).val().length <= 4){
                $('#shipping_rate').val('');
            }

        });        
        
        $("#shipping_day_set").change(function() {
            var formData = $('#shippingaddressform').serializeArray();
            $.ajax({
                url: "{{ URL::route('app.products.usps') }}",
                type: "POST",
                data: formData,
                success: function (msg) {
                        if(msg != 'usps limit over'){
                            if(msg.Package.Error){
                                $('#shipping_rate').val('');
                                swal({
                                    title: msg.Package.Error.Description,
                                    icon: "error",
                                    closeOnClickOutside: false});

                            }else{
                                $('#shipping_rate').val(msg.Package.Postage.Rate);
                            }
                        }else{
                            swal({
                                title: "USPS limit over. Your product should be less then 70lbs",
                                icon: "error",
                                closeOnClickOutside: false});
                        }
                }
            }); 
        });
    </script>
@stop
