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
                <h2>{{ __('My Subscriptions') }}</h2>
            </div>
        </div><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="subscriptions">
                <thead>
                    <tr>
                        <th class="align-center">{{ __('Plan') }}</th>
                        <th class="align-center">{{ __('Starts At') }}</th>
                        <th class="align-center">{{ __('Ends At') }}</th>
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
            $('#subscriptions').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/me/subscriptions/datatables' },
                columns: [
                    { data: 'plan', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            return data.name + " ($" + parseFloat(Math.round(data.price * 100) / 100).toFixed(2)  + ")"
                        }
                    },
                    { data: 'starts_at', 
                        render: function ( data, type, row, meta ) {
                            return new Date(data).toLocaleString();
                        }
                    },
                    { data: 'ends_at', 
                        render: function ( data, type, row, meta ) {
                            return new Date(data).toLocaleString();
                        }
                    }
                ]
            });
        });
    </script>
@stop
