@extends('layouts.admin')
@section('page-title')
    {{ __('Anew Avenue Biomagnestim | Administrator - Pairs') }}
@stop
@section('styles')
    @parent
@stop
@section('content')
    @csrf
    <div id="content-container">
        <h2>
            {{ __('Pairs') }} 
            <button class="editor-new fa fa-plus" data-toggle="modal" data-target="#pairModal" data-title="New Pair"></button>
            <button class="editor-new fa fa-upload" onclick="window.location.href='/admin/pairs/import'"></button>
        </h2><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="pairs" >
                <thead>
                    <tr>
                        <th class="align-center">{{ __('Ref No.') }}</th>
                        <th class="align-left">{{ __('Scan Type') }}</th>
                        <th class="align-left">{{ __('Points / Name') }}</th>
                        <th class="align-left">{{ __('Radical') }}</th>
                        <th class="align-left">{{ __('Start / Origin') }}</th>
                        <th class="align-left">{{ __('Leads / Symptoms') }}</th>
                        <th class="align-left">{{ __('Path / Route / Cause and Effect') }}</th>
                        <th class="align-left">{{ __('Alternative Routes') }}</th>
                        <th class="align-left">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pairModal" tabindex="-1" role="dialog" aria-labelledby="pairModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pairModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
            <div class="modal-body">
                <input type="hidden" id="pair_id" name="pair_id">
                <div class="form-group">
                    <label for="target">Scan Type</label>
                    <select class="form-control" id="scan_type" name="scan_type" required>
                        <option value="body_scan">Body Scan</option>
                        <option value="chakra_scan">Chakra Scan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Ref No.</label>
                    <input type="text" class="form-control" id="ref_no" name="ref_no" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="radical">Radical</label>
                    <input type="text" class="form-control" id="radical" name="radical">
                </div>
                <div class="form-group">
                    <label for="origins">Start / Origin</label>
                    <textarea class="form-control" id="origins" name="origins"></textarea>
                </div>
                <div class="form-group">
                    <label for="symptoms">Leads / Symptoms</label>
                    <textarea class="form-control" id="symptoms" name="symptoms"></textarea>
                </div>
                <div class="form-group">
                    <label for="paths">Path / Route / Cause and Effect</label>
                    <textarea class="form-control" id="paths" name="paths"></textarea>
                </div>
                <div class="form-group">
                    <label for="alternative_routes">Alternative Routes</label>
                    <textarea class="form-control" id="alternative_routes" name="alternative_routes"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-btn">Save</button>
            </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            // New record
            $('#pairs').on('click', 'button.editor-new', function (e) {
                e.preventDefault();
            } );

            // Edit record
            $('#pairModal').on('show.bs.modal', function (e) {
                var trigger = $(e.relatedTarget)
                $('#pairModalTitle').text(trigger.data('title'));

                // Retrieve pair 
                $pair_id = trigger.data('id')
                $.ajax({
                    url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/pairs/'+$pair_id,
                    type: 'GET',
                    success: function(result) {
                        $('#pair_id').val(result.id);
                        $('#scan_type').val(result.scan_type);
                        $('#ref_no').val(result.ref_no);
                        $('#name').val(result.name);
                        $('#radical').val(result.radical);
                        $('#origins').val(result.origins != null ? String(result.origins) : '');
                        $('#symptoms').val(result.symptoms != null ? String(result.symptoms) : '');
                        $('#paths').val(result.paths != null ? String(result.paths) : '');
                        $('#alternative_routes').val(result.alternative_routes != null ? String(result.alternative_routes) : '');
                    }
                });
            })

            // Save a record
            $(".save-btn").click(function(e){
                e.preventDefault();

                var $pair_id = $('#pair_id').val()

                var privacy;
                if ($('#privacy').is(":checked")){
                    privacy = 1
                } else {
                    privacy = 0
                }

                var data = {
                    scan_type: $("#scan_type").val(),
                    ref_no: $("#ref_no").val(),
                    name: $("#name").val(),
                    radical: $("#radical").val(),
                    origins: $("#origins").val(),
                    symptoms: $("#symptoms").val(),
                    paths: $("#paths").val(),
                    alternative_routes: $("#alternative_routes").val()
                };


                if ($("#scan_type").val() == '' || $("#scan_type").val() == null) {
                    alert('Scan Type must be filled out.')
                    $("#scan_type").focus()
                } else {
                    if ($pair_id != undefined && $pair_id != '') {
                        $.ajax({
                            url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/pairs/'+$pair_id,
                            type: 'PUT',
                            data: data,
                            dataType: 'JSON',
                            success: function (data) { 
                                location.reload();
                            }
                        });
                    } else {
                        $.ajax({
                            url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/pairs',
                            type: 'POST',
                            data: data,
                            dataType: 'JSON',
                            success: function (data) { 
                                location.reload();
                            }
                        });
                    }
                }
            });
        
            // Delete a record
            $('#pairs').on('click', 'button.editor-remove', function (e) {
                e.preventDefault();

                $pair_id = $(this).attr('data-id')

                var confirmDialog = confirm("Are you sure you wish to delete this pair?");
                if (confirmDialog == true) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/pairs/'+$pair_id,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                }
            } );

            $('#pairs').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/pairs/datatables' },
                columns: [
                    {
                        data: 'ref_no', 
                        className: 'dt-body-center',
                        render: function ( data, type, row, meta ) {
                            if (data != '' && data != null) {
                                return data;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'scan_type',
                        render: function ( data, type, row, meta ) {
                            if (data == 'body_scan') {
                                return 'Body Scan'
                            } else if (data == 'chakra_scan') {
                                return 'Chakra Scan'
                            } else {
                                return data
                            }
                        }
                    },
                    { data: 'name', name: 'name' },
                    { data: 'radical', name: 'radical' },
                    { data: 'origins', name: 'origins' },
                    { data: 'symptoms', name: 'symptoms' },
                    { data: 'paths', name: 'paths' },
                    { data: 'alternative_routes', name: 'alternative_routes' },
                    {
                        data: 'id',
                        className: "dt-body-center",
                        "orderable": false,
                        render: function ( data, type, row, meta ) {
                            return '<button class="editor-edit fa fa-edit fa-2x" data-toggle="modal" data-target="#pairModal" data-title="Edit Pair" data-id="'+data+'"></button><button class="editor-remove fa fa-trash-o fa-2x"data-id="'+data+'"></button>';
                        }
                    }
                ]
            });
        });
    </script>
@stop
