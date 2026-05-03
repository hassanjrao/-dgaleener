@extends('layouts.admin')
@section('page-title')
    {{ __('Anew Avenue Biomagnetism | Administrator - Dr Goiz Pairs') }}
@stop
@section('styles')
    @parent

    <style>
        .modal-body .form-group {
            padding-left: 0;
        }

        .pd-l-0 {
            padding-left: 0;
        }

        .pd-r-0 {
            padding-right: 0;
        }
    </style>
@stop
@section('content')
    @csrf
    <div id="content-container">
        <h2>
            {{ __('Dr. Goiz Pairs') }}
            <button class="editor-new fa fa-plus" data-toggle="modal" data-target="#drGoizPairModal"
                data-title="New Dr. Goiz Pair"></button>
        </h2><br />
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="dr_goiz_pairs">
                <thead>
                    <tr>
                        <th class="align-left">{{ __('Place') }}</th>
                        <th class="align-left">{{ __('Resonance') }}</th>
                        <th class="align-left">{{ __('Name') }}</th>
                        <th class="align-left">{{ __('Characteristic') }}</th>
                        <th class="align-left">{{ __('Description') }}</th>
                        <th class="align-left">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="drGoizPairModal" tabindex="-1" role="dialog" aria-labelledby="drGoizPairModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="drGoizPairModalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" id="dr_goiz_pair_id" name="dr_goiz_pair_id">

                        <div class="row" style="margin: 0;">
                            <div class="col-md-6 form-group pd-l-0">
                                <label for="place">Place (EN)</label>
                                <input type="text" class="form-control" id="place" name="place">
                            </div>
                            <div class="col-md-6 form-group pd-r-0">
                                <label for="place_es">Place (ES)</label>
                                <input type="text" class="form-control" id="place_es" name="place_es">
                            </div>
                        </div>

                        <div class="row" style="margin: 0;">
                            <div class="col-md-6 form-group pd-l-0">
                                <label for="resonance">Resonance (EN)</label>
                                <input type="text" class="form-control" id="resonance" name="resonance">
                            </div>
                            <div class="col-md-6 form-group pd-r-0">
                                <label for="resonance_es">Resonance (ES)</label>
                                <input type="text" class="form-control" id="resonance_es" name="resonance_es">
                            </div>
                        </div>

                        <div class="row" style="margin: 0;">
                            <div class="col-md-6 form-group pd-l-0">
                                <label for="name">Name (EN)</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 form-group pd-r-0">
                                <label for="name_es">Name (ES)</label>
                                <input type="text" class="form-control" id="name_es" name="name_es">
                            </div>
                        </div>

                        <div class="row" style="margin: 0;">
                            <div class="col-md-6 form-group pd-l-0">
                                <label for="characteristic">Characteristic (EN)</label>
                                <textarea class="form-control" id="characteristic" name="characteristic" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 form-group pd-r-0">
                                <label for="characteristic_es">Characteristic (ES)</label>
                                <textarea class="form-control" id="characteristic_es" name="characteristic_es" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row" style="margin: 0;">
                            <div class="col-md-6 form-group pd-l-0">
                                <label for="description">Description (EN)</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 form-group pd-r-0">
                                <label for="description_es">Description (ES)</label>
                                <textarea class="form-control" id="description_es" name="description_es" rows="3"></textarea>
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
            $('#dr_goiz_pairs').on('click', 'button.editor-new', function(e) {
                e.preventDefault();
            });

            // Edit record
            $('#drGoizPairModal').on('show.bs.modal', function(e) {
                var trigger = $(e.relatedTarget);
                $('#drGoizPairModalTitle').text(trigger.data('title'));

                var $pair_id = trigger.data('id');
                if ($pair_id != undefined && $pair_id != '') {
                    $.ajax({
                        url: '{{ env('APP_WEB_API_URL') }}/{{ env('APP_WEB_API_VERSION') }}/dr_goiz_pairs/' +
                            $pair_id,
                        type: 'GET',
                        success: function(result) {
                            $('#dr_goiz_pair_id').val(result.id);
                            $('#place').val(result.place != null ? result.place : '');
                            $('#place_es').val(result.place_es != null ? result.place_es : '');
                            $('#resonance').val(result.resonance != null ? result.resonance :
                                '');
                            $('#resonance_es').val(result.resonance_es != null ? result
                                .resonance_es : '');
                            $('#name').val(result.name != null ? result.name : '');
                            $('#name_es').val(result.name_es != null ? result.name_es : '');
                            $('#characteristic').val(result.characteristic != null ? String(
                                result.characteristic) : '');
                            $('#characteristic_es').val(result.characteristic_es != null ?
                                String(result.characteristic_es) : '');
                            $('#description').val(result.description != null ? String(result
                                .description) : '');
                            $('#description_es').val(result.description_es != null ? String(
                                result.description_es) : '');
                        }
                    });
                } else {
                    $('#dr_goiz_pair_id').val('');
                    $('#place').val('');
                    $('#place_es').val('');
                    $('#resonance').val('');
                    $('#resonance_es').val('');
                    $('#name').val('');
                    $('#name_es').val('');
                    $('#characteristic').val('');
                    $('#characteristic_es').val('');
                    $('#description').val('');
                    $('#description_es').val('');
                }
            });

            // Save a record
            $(".save-btn").click(function(e) {
                e.preventDefault();

                var $pair_id = $('#dr_goiz_pair_id').val();

                if ($('#name').val() == '') {
                    alert('Name (EN) must be filled out.');
                    $('#name').focus();
                    return;
                }

                var data = {
                    place: $("#place").val(),
                    place_es: $("#place_es").val(),
                    resonance: $("#resonance").val(),
                    resonance_es: $("#resonance_es").val(),
                    name: $("#name").val(),
                    name_es: $("#name_es").val(),
                    characteristic: $("#characteristic").val(),
                    characteristic_es: $("#characteristic_es").val(),
                    description: $("#description").val(),
                    description_es: $("#description_es").val()
                };

                if ($pair_id != undefined && $pair_id != '') {
                    $.ajax({
                        url: '{{ env('APP_WEB_API_URL') }}/{{ env('APP_WEB_API_VERSION') }}/dr_goiz_pairs/' +
                            $pair_id,
                        type: 'PUT',
                        data: data,
                        dataType: 'JSON',
                        success: function(data) {
                            location.reload();
                        }
                    });
                } else {
                    $.ajax({
                        url: '{{ env('APP_WEB_API_URL') }}/{{ env('APP_WEB_API_VERSION') }}/dr_goiz_pairs',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            });

            // Delete a record
            $('#dr_goiz_pairs').on('click', 'button.editor-remove', function(e) {
                e.preventDefault();

                var $pair_id = $(this).attr('data-id');

                var confirmDialog = confirm("Are you sure you wish to delete this Dr. Goiz pair?");
                if (confirmDialog == true) {
                    $.ajax({
                        url: '{{ env('APP_WEB_API_URL') }}/{{ env('APP_WEB_API_VERSION') }}/dr_goiz_pairs/' +
                            $pair_id,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                }
            });

            $('#dr_goiz_pairs').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ env('APP_WEB_API_URL') }}/{{ env('APP_WEB_API_VERSION') }}/dr_goiz_pairs/datatables'
                },
                columns: [{
                        data: 'place',
                        name: 'place',
                        render: function(data, type, row) {
                            var en = data || '';
                            var es = row.place_es || '';
                            return en + (es ? ' / <span style="color:#888;font-style:italic;">' +
                                es + '</span>' : '');
                        }
                    },
                    {
                        data: 'resonance',
                        name: 'resonance',
                        render: function(data, type, row) {
                            var en = data || '';
                            var es = row.resonance_es || '';
                            return en + (es ? ' / <span style="color:#888;font-style:italic;">' +
                                es + '</span>' : '');
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            var en = data || '';
                            var es = row.name_es || '';
                            return en + (es ? ' / <span style="color:#888;font-style:italic;">' +
                                es + '</span>' : '');
                        }
                    },
                    {
                        data: 'characteristic',
                        name: 'characteristic',
                        render: function(data, type, row) {
                            var en = data || '';
                            var es = row.characteristic_es || '';
                            return en + (es ? ' / <span style="color:#888;font-style:italic;">' +
                                es + '</span>' : '');
                        }
                    },
                    {
                        data: 'description',
                        name: 'description',
                        render: function(data, type, row) {
                            var en = data || '';
                            var es = row.description_es || '';
                            return en + (es ? ' / <span style="color:#888;font-style:italic;">' +
                                es + '</span>' : '');
                        }
                    },
                    {
                        data: 'id',
                        className: "dt-body-center",
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return '<button class="editor-edit fa fa-edit fa-2x" data-toggle="modal" data-target="#drGoizPairModal" data-title="Edit Dr. Goiz Pair" data-id="' +
                                data + '"></button>' +
                                '<button class="editor-remove fa fa-trash-o fa-2x" data-id="' +
                                data + '"></button>';
                        }
                    }
                ]
            });
        });
    </script>
@stop
