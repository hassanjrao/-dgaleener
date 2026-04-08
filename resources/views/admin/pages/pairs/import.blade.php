@extends('layouts.admin')
@section('page-title')
    {{ __('Anew Avenue Biomagnestim | Administrator') }}
@stop
@section('content')
    <div id="content-container">
        <h2>{{ __('Pairs Files') }}</h2>
        <h8>{{ __('Only files of format .xls or .xlsx are accepted. Please note that first row should always be the column headers.') }}</h8>
        <br/><br/>
        
        <form id="import-form" action="{{ url('/admin/pairs/parse') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row col-md-12 form-group">
                <div class="col-md-2">
                    <select class="form-control" id="scan_type" name="scan_type" data-scan_type="{{$request->scan_type}}" required>
                        <option value="body_scan">Bio</option>
                        <option value="chakra_scan">Chakra</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="file" name="pair_file" id="fileToUpload" class="form-control" accept=".xls,.xlsx" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" value="submit">{{ __('Upload and Parse') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('javascripts')
    @parent

    <script>
        $(document).ready(function() {
            document.getElementById("scan_type").value = $("#scan_type").data('scan_type');
        })
    </script>
@stop
