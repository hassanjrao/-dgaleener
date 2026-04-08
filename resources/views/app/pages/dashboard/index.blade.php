@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Dashboard'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'Anew Avenue'])
    <div class="container">
        <div class="row">
            <div class="row justify-content-center signup-form-row">
                <div class="col-md-12 text-xs-left text-sm-center">
                    <h1 class="text-center" style="margin-bottom:35px">{{ __('Ion Positive and Negative Changes') }}</h1>
                    <h3 style="margin-bottom:35px">{{ __('Engage to discover transforming energy to alignment, channeling cell activity with magnet fields to wellness.') }}</h3>
                    <h5 style="margin-bottom:35px">{{ __('A broad approach to positive and negative electron fields, working to eradicate diseases. (toxins, endotoxins, radicals, dysfunctions, emotional crisis, embedded negative codes, negative memory and PH imbalance.)') }}</h5>
                    <h3 class="text-center">{{ __('A journey to health - Biomagnetism Therapy') }}</h3>
                    <br/><br/>
                    <div class="row col-md-12 col-xs-12">
                        <div class="col-md-3 col-xs-3 text-center dashboard-menu">
                            <a href="{{ route('app.bodyscan.info') }}" target="_blank">
                                <img src="{{asset('/images/iconimages/bodyscan312.png')}}" title="{{ __('Body Scan') }}" alt="{{ env('APP_TITLE') }}" style="width:216px;height:212px;margin-bottom:15px;">
                            </a>
                            <a href="{{ route('app.bodyscan.info') }}" target="_blank">
                                <button type="button" class="btn btn-primary dashboard-learn-more" style="margin-bottom:15px">{{ __('Learn More') }}</button>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-3 text-center dashboard-menu">
                            <a href="{{ route('app.chakrascan.info') }}" target="_blank">
                                <img src="{{asset('/images/iconimages/chakra312.png')}}" title="{{ __('Chakra Scan') }}" style="width:216px;height:212px;margin-bottom:15px;">
                            </a>
                            <a href="{{ route('app.chakrascan.info') }}" target="_blank">
                                <button type="button" class="btn btn-primary dashboard-learn-more" style="margin-bottom:15px">{{ __('Learn More') }}</button>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-3 text-center dashboard-menu">
                            <a href="{{ route('app.data_cache.info') }}" target="_blank">
                                <img src="{{asset('/images/iconimages/datalog312.png')}}" title="{{ __('Data Cache') }}" alt="{{ env('APP_TITLE') }}" style="width:216px;height:212px;margin-bottom:15px;">
                            </a>
                            <a href="{{ route('app.data_cache.info') }}" target="_blank">
                                <button type="button" class="btn btn-primary dashboard-learn-more" style="margin-bottom:15px">{{ __('Learn More') }}</button>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-3 text-center dashboard-menu">
                            <a href="{{ route('app.bioconnect.info') }}" target="_blank">
                                <img src="{{asset('/images/iconimages/bio312.png')}}" title="{{ __('Bio Connect') }}" alt="{{ env('APP_TITLE') }}" style="width:216px;height:212px;margin-bottom:15px;">
                            </a>
                            <a href="{{ route('app.bioconnect.info') }}" target="_blank">
                                <button type="button" class="btn btn-primary dashboard-learn-more" style="margin-bottom:15px">{{ __('Learn More') }}</button>
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
