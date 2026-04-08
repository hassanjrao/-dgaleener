@extends('layouts.admin')
@section('page-title')
    {{ __('Anew Avenue Biomagnestim | Administrator - Model Labels') }}
@stop
@section('styles')
    @parent
@stop
@section('content')
    @csrf
    <div id="content-container">
        <h2>
            {{ __('Model Labels for Body Scan') }}
            <button class="editor-new fa fa-plus" data-toggle="modal" data-target="#modelLabelModal" data-title="New Model Label"></button>
        </h2><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="model_labels">
                <thead>
                    <tr>
                        <th class="align-center">{{ __('ID') }}</th>
                        <th class="align-left">{{ __('Target') }}</th>
                        <th class="align-center">{{ __('Point') }}</th>
                        <th class="align-left">{{ __('Point X') }}</th>
                        <th class="align-left">{{ __('Point Y') }}</th>
                        <th class="align-left">{{ __('Point Z') }}</th>
                        <th class="align-left">{{ __('Label') }}</th>
                        <th class="align-left">{{ __('Label X') }}</th>
                        <th class="align-left">{{ __('Label Y') }}</th>
                        <th class="align-left">{{ __('Label Z') }}</th>
                        <th class="align-left">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelLabelModal" tabindex="-1" role="dialog" aria-labelledby="modelLabelModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelLabelModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
            <div class="modal-body">
                <input type="hidden" id="model_label_id" name="model_label_id">
                <div class="form-group">
                    <label for="target">Scan Type</label>
                    <select class="form-control" id="scan_type" name="scan_type" required disabled>
                        <option value="body_scan" selected>Body Scan</option>
                        <option value="chakra_scan">Chakra Scan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="target">Target</label>
                    <select class="form-control" id="target" name="target" required>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="label">Point</label>
                    <select class="form-control" id="pair_id" name="pair_id" required>
                        @foreach(\App\Models\Pair::orderBy('name', 'asc')->where('scan_type', '=', 'body_scan')->get() as $pair)
                            <option value="{{$pair->id}}">{{$pair->name}}</option>
                        @endforeach
                    </select>
                </div>
                <label>Point Coordinates</label>
                <div class="form-group row">
                    <div class="col">
                        <label>X</label>
                        <input type="number" class="form-control" id="point_x" name="point_x" required>
                    </div>
                    <div class="col">
                        <label>Y</label>
                        <input type="number" class="form-control" id="point_y" name="point_y" required>
                    </div>
                    <div class="col">
                        <label>Z</label>
                        <input type="number" class="form-control" id="point_z" name="point_z" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="label">Label</label>
                    <input type="text" class="form-control" id="label" name="label" required>
                </div>
                <label>Label Coordinates</label>
                <div class="form-group row">
                    <div class="col">
                        <label>X</label>
                        <input type="number" class="form-control" id="label_x" name="label_x" required>
                    </div>
                    <div class="col">
                        <label>Y</label>
                        <input type="number" class="form-control" id="label_y" name="label_y" required>
                    </div>
                    <div class="col">
                        <label>Z</label>
                        <input type="number" class="form-control" id="label_z" name="label_z" required>
                    </div>
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
            $('#model_labels').on('click', 'button.editor-new', function (e) {
                e.preventDefault();
            } );

            // Edit record
            $('#modelLabelModal').on('show.bs.modal', function (e) {
                var trigger = $(e.relatedTarget)
                $('#modelLabelModalTitle').text(trigger.data('title'));

                // Retrieve model_label 
                $model_label_id = trigger.data('id')
                if ($model_label_id != null) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/model_labels/'+$model_label_id,
                        type: 'GET',
                        success: function(result) {
                            $('#model_label_id').val(result.id);
                            $('#scan_type').val(result.scan_type);
                            $('#target').val(result.target);
                            $('#pair_id').val(result.pair_id);
                            $('#point_x').val(result.point_x);
                            $('#point_y').val(result.point_y);
                            $('#point_z').val(result.point_z);
                            $('#label').val(result.label);
                            $('#label_x').val(result.label_x);
                            $('#label_y').val(result.label_y);
                            $('#label_z').val(result.label_z);
                        }
                    });
                } else {
                    $('#model_label_id').val('');
                    $('#target').val('female');
                    $('#scan_type').val('body_scan');
                    $('#pair_id').val(null);
                    $('#point_x').val(0);
                    $('#point_y').val(0);
                    $('#point_z').val(0);
                    $('#label').val('');
                    $('#label_x').val(0);
                    $('#label_y').val(0);
                    $('#label_z').val(0);
                }
            })

            // Save a record
            $(".save-btn").click(function(e){
                e.preventDefault();

                var $model_label_id = $('#model_label_id').val()

                var data = {
                    target: $("#target").val(),
                    scan_type: $("#scan_type").val(),
                    pair_id: $("#pair_id").val(),
                    point_x: $("#point_x").val(),
                    point_y: $("#point_y").val(),
                    point_z: $("#point_z").val(),
                    label: $("#label").val(),
                    label_x: $('#label_x').val(),
                    label_y: $('#label_y').val(),
                    label_z: $('#label_z').val()
                };

                if ($("#target").val() == '' || $("#target").val() == null) {
                    alert('Target must be filled out.')
                    $("#target").focus()
                } else if ($("#scan_type").val() == '' || $("#scan_type").val() == null) {
                    alert('Scan type must be filled out.')
                    $("#scan_type").focus()
                } else if ($("#pair_id").val() == '' || $("#pair_id").val() == null) {
                    alert('Point must be filled out.')
                    $("#pair_id").focus()
                } else if ($("#point_x").val() == '' || $("#point_x").val() == null) {
                    alert('Point X must be filled out.')
                    $("#point_x").focus()
                } else if ($("#point_y").val() == '' || $("#point_y").val() == null) {
                    alert('Point Y must be filled out.')
                    $("#point_y").focus()
                } else if ($("#point_z").val() == '' || $("#point_z").val() == null) {
                    alert('Point Z must be filled out.')
                    $("#point_z").focus()
                } else {
                    if ($model_label_id != undefined && $model_label_id != '') {
                        $.ajax({
                            url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/model_labels/'+$model_label_id,
                            type: 'PUT',
                            data: data,
                            dataType: 'JSON',
                            success: function (data) { 
                                location.reload();
                            }
                        }); 
                    } else {
                        $.ajax({
                            url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/model_labels',
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
            $('#model_labels').on('click', 'button.editor-remove', function (e) {
                e.preventDefault();

                $model_label_id = $(this).attr('data-id')

                var confirmDialog = confirm("Are you sure you wish to delete this model label?");
                if (confirmDialog == true) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/model_labels/'+$model_label_id,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                }
            } );

            $('#model_labels').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/model_labels/datatables?scan_type=body_scan' },
                columns: [
                    { data: 'id', name: 'id', className: 'dt-body-center' },
                    { data: 'target', name: 'target' },
                    { data: 'point.name', name: 'point_name', searchable: false, "orderable": false },
                    { data: 'point_x', name: 'point_x' },
                    { data: 'point_y', name: 'point_y' },
                    { data: 'point_z', name: 'point_z' },
                    { data: 'label', name: 'label' },
                    { data: 'label_x', name: 'label_x' },
                    { data: 'label_y', name: 'label_y' },
                    { data: 'label_z', name: 'label_z' },
                    {
                        data: 'id',
                        className: "dt-body-center",
                        "orderable": false,
                        render: function ( data, type, row, meta ) {
                            return '<button class="editor-remove fa fa-trash-o fa-2x" style="color: red;" data-id="'+data+'"></button><button class="editor-edit fa fa-edit fa-2x" data-toggle="modal" data-target="#modelLabelModal" data-title="Edit Model Label" data-id="'+data+'"></button>';
                        }
                    }
                ]
            });
        });
    </script>
@stop
