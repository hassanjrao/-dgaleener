@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Products'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'Products'])
    <div class="container" style="padding-top: 120px;">
        <div class="row" style="display: block;">
            <div class="row justify-content-center signup-form-row">
                <div class="col-md-12 text-xs-left text-sm-center">
                    <h2 class="text-center" style="margin-bottom:35px">{{ __('Magnets') }}</h2>
                    <div class="row col-md-12 col-xs-12">
                        <div class="col-md-6 col-xs-12 text-center dashboard-menu">
                            <a href="/products/bio" name="products-bio" target="_blank">
                                <img src="{{asset('/images/products/images/bio.jpg')}}" title="{{ __('Bio Magnets') }}" alt="{{ env('APP_TITLE') }}" style="width:216px;height:212px;margin-bottom:15px;">
                            </a>
                        </div>
                        <div class="col-md-6 col-xs-12 text-center dashboard-menu">
                            <a href="/products/chakra" name="products-chakra"  target="_blank">
                                <img src="{{asset('/images/products/images/chakra.jpg')}}" title="{{ __('Chakra Magnets') }}" alt="{{ env('APP_TITLE') }}" style="width:216px;height:212px;margin-bottom:15px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
@stop
