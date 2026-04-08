
@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Magnets'}}
@stop
@section('styles')
    @parent

    <link href="{{ asset('css/app/products.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => ''])

    <div id="content-container" style="margin: 50px;">
        <div class="row col-md-12">
            <div class="col-md-8">
                <h2>{{ __('My Payments') }}</h2>
            </div>
        </div><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="payments">
                <thead>
                    <tr>
                        <th class="align-center">{{ __('Date') }}</th>
                        <th class="align-center">{{ __('Description') }}</th>
                        <th class="align-center">{{ __('Amount') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent

    <script>
        $(document).ready(function() {
            $('#payments').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/me/payments/datatables' },
                columns: [
                    { data: 'date_paid' },
                    { data: 'description' },
                    { data: 'amount', 
                        render: function ( data, type, row, meta ) {
                            return '$' + data;
                        }
                    }
                ]
            });
        });
    </script>
@stop
