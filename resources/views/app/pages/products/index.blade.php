@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | More'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'More'])
    <div class="container" style="padding-top: 120px;">
        <div class="row" style="display: block;">
            <div class="row justify-content-center signup-form-row">
                <div class="col-md-8 text-center">
                    <h2 class="text-center" style="margin-bottom: 8px;">{{ __('More') }}</h2>
                    <h3 class="text-center" style="color: #ff5a47; font-weight: 400; margin-bottom: 30px;">Más</h3>
                    <div class="panel panel-default" style="margin-bottom: 0;">
                        <div class="panel-body" style="padding: 42px 30px;">
                            <p style="font-size: 1.15rem; margin-bottom: 10px;">
                                This section is being updated.
                            </p>
                            <p style="color: #ff5a47; font-size: 1.15rem; margin-bottom: 0;">
                                Esta sección se está actualizando.
                            </p>
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
