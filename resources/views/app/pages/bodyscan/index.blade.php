@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Biomagnetism Body Scan'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'Body Scan', 'image_url' => '/images/iconimages/humanicon48.png'])
    @php ($target = request()->target ?? 'female')
    <div style="display: none;" id="scanType" data-value="body_scan"></div>
    <div style="display: none;" id="modelTarget" data-value="{{$target}}"></div>
    <div style="display: none;" id="userIsAdmin" data-value="{{Auth::user()->isAdmin() ? 'administrator' : ''}}"></div>
    <div style="display: none;" id="ssid" data-value="{{$request->ssid}}"></div>
    <div style="display: none;" id="guided" data-value="{{$request->guided ?? 'false'}}"></div>
    <div style="display: none;" id="page" data-value="{{$request->page ?? 1}}"></div>
    <div style="display: none;" id="perPage" data-value="{{$request->perPage ?? 5}}"></div>
    <div class="container scan-container" ng-controller="ModelLabelsCtrl as ctrl">
        <div class="loader" style="margin:0 auto; margin-top: 100px;" ng-if="!(ctrl.search.meta.loaded | valPresent) || !ctrl.search.meta.loaded"></div>
        <div class="row justify-content-center signup-form-row" ng-hide="!ctrl.search.meta.loaded">
            <div class="row col-md-12" style="padding-left: 0;">
                <div class="col-md-6 col-xs-6" style="padding-left: 25px;">
                    <div id="modelcontainer" style="display: none;"></div>
                    <div id="toggleModel" class="scan-toggle-model" style="display: none;">
                        @if ($target == 'male')
                            <a href="/bodyscan?target=female&guided=<% ctrl.guided_scan %>">
                                <button>Switch to Female</button>
                            </a>
                        @else
                            <a href="/bodyscan?target=male&guided=<% ctrl.guided_scan %>">
                                <button>Switch to Male</button>
                            </a>
                        @endif
                        <span style="margin: 0 30px;">
                        <button id="zoomIn" ng-click="ctrl.zoomIn($event)">
                            Zoom In
                        </button>
                        <button id="zoomOut" ng-click="ctrl.zoomOut($event)">
                            Zoom Out
                        </button>
                        <span style="margin: 0 30px;">
                        <button id="prevPoint" ng-click="ctrl.prevPoint($event)">
                            Previous
                        </button>
                        <button id="nextPoint" ng-click="ctrl.nextPoint($event)">
                            Next
                        </button>
                        <span style="margin: 0 30px;">
                        @if(Auth::user()->isAdmin())
                            <button id="addPoint" data-toggle="modal" data-target="#modelLabelModal" data-title="Add Model Label" ng-if="!(ctrl.client | valPresent)" disabled>Add</button>
                            <!-- <br>
                            <span id="mouseX">Mouse X: 0</span>
                            <span id="mouseY">Mouse Y: 0</span> -->
                            <span id="pointX" data-value="0" style="display: none;">Point X: 0</span>
                            <span id="pointY" data-value="0" style="display: none;">Point Y: 0</span>
                            <span id="pointZ" data-value="0" style="display: none;">Point Z: 0</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 col-xs-6 scan-point-container" ng-cloak="">
                    <h6 style="font-size: 28px; text-align: center;" ng-if="(ctrl.model_labels.length > 0) && ctrl.disable_client_selection"><a href="/data_cache/clients/<% ctrl.client.id %>" target="_blank"><% ctrl.client.name %></a></h6>
                    <div class="row scan-search-box" ng-if="ctrl.model_labels.length > 0">
                        <img src="{{asset('/images/scan-search-icon.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                        <form>
                            <input type="text" placeholder="Search..." ng-model="ctrl.search.params.text" style="width: calc(100% - 66px)"></input>
                            <select ng-model="ctrl.search.meta.perPage" style="width: 62px; height: 28px;">
                                <option ng-repeat="itemsPerPage in ctrl.search.perPageOptions" ng-value="itemsPerPage"><% itemsPerPage %></option>
                            </select>
                        </form>
                    </div>
                    <div class="row" style="margin: 8px 0;">
                        @if ($request->guided == 'true')
                        <a href="/bodyscan?target=<% ctrl.search.params.target %>&guided=false">
                            <button style="margin: 8px; margin-right: 0;">Switch to Non Guided Scan</button>
                        </a>
                        @else
                        <a href="/bodyscan?target=<% ctrl.search.params.target %>&guided=true">
                            <button style="margin: 8px; margin-right: 0;">Switch to Guided Scan</button>
                        </a>
                        @endif
                        <button class="pull-right" style="margin: 8px; margin-right: 0;" ng-click="ctrl.showBookmark = (ctrl.showBookmark ? false : true)"><% ctrl.showBookmark ? 'Hide' : 'Show' %> Bookmarks</button>
                    </div>
                    <div class="row" style="margin: 8px;" ng-if="ctrl.showBookmark">
                        <input type="text" ng-model="bookmark_record.name" style="<% (bookmark_record.id | valPresent) ? 'width: calc(100% - 129px)' : 'width: calc(100% - 57px)' %>" placeholder="Bookmark Title"></input>
                        <button style="margin-left: 8px;" ng-click="ctrl.saveBookmark(bookmark_record)" ng-disabled="!(bookmark_record.name | valPresent)">Save</button>
                        <button style="margin-left: 8px;" ng-click="ctrl.clearBookmark()" ng-if="(bookmark_record.id | valPresent)">Cancel</button>
                        <div class="text-center" style="margin: 16px 0; width: 100%;">
                            <span ng-if="!(ctrl.bookmarks | valPresent)">You have no saved bookmarks.</span>
                        </div>
                        <table border="1" style="width: 100%; margin: 8px 32px;" ng-if="ctrl.bookmarks | valPresent">
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center" style="width: 120px;"></th>
                            </tr>
                            <tr ng-repeat="bookmark in ctrl.bookmarks track by bookmark.id">
                                <td><a href="<% bookmark.url %>"><% bookmark.name %></a></td>
                                <td><% bookmark.created_at %></td>
                                <td class="text-center">
                                    <button ng-if="bookmark.editable" ng-click="ctrl.editBookmark(bookmark)" ng-disabled="(bookmark_record.id | valPresent)">Edit</button>
                                    <button ng-if="bookmark.deletable" style="color: red;" ng-click="ctrl.deleteBookmark(bookmark)" ng-disabled="(bookmark_record.id | valPresent)">Delete</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="row" style="margin: 8px 0;" ng-if="(ctrl.model_labels.length > 0) && !ctrl.disable_client_selection">
                        <label style="margin: 8px;" ng-if="ctrl.clients | valPresent">Client:</label>
                            <select class="form-control" id="client_id" name="client_id" ng-model="ctrl.client" style="width: calc(100% - 219px)" ng-if="ctrl.clients | valPresent">
                                <option ng-value="null">(No client selected)</option>
                                <option ng-repeat="client in ctrl.clients | where: { gender: ctrl.search.params.target, user_id: {{ Auth::user()->id }} } track by client.id" ng-value="<% client %>"><% client.name %></option>
                            </select>
                        <a href="/data_cache/clients/<% ctrl.client.id %>?scan_type=body_scan" target="_blank"><button class="btn-data-cache" style="margin: 8px; margin-right: 0; width: 66px;" ng-disabled="!(ctrl.client | valPresent)" ng-if="ctrl.clients | valPresent">View</button></a>
                        <a href="/data_cache/client_info" target="_blank"><button class="btn-data-cache" style="margin: 8px; width: 66px;" ng-disabled="ctrl.client | valPresent" ng-if="ctrl.clients | valPresent">Add</button></a>
                    </div>
                    <div class="text-center">
                        <span style="font-size: 16.5px;" ng-if="(ctrl.client | valPresent) && !(ctrl.client.scan_session_id | valPresent)"> No active scan session for this client. <a href="/data_cache/clients/<% ctrl.client.id %>">Click here to create a scan session.</a></span>
                    </div>
                    <h5 ng-if="ctrl.model_labels.length > 0" style="margin: 8px 0;"><% ctrl.search.meta.pageStatus %></h5>
                    <div class="row second-layer">
                        <span style="margin-left: 50px; margin-top: 10px;" ng-if="(ctrl.model_labels | filter: { point: { name: ctrl.search.params.text } }).length == 0">No results found.</span>
                        <ul id="accordion" ng-if="ctrl.model_labels.length > 0" style="width: 100%;">
                            <li ng-repeat="model_label in ctrl.model_labels | orderBy: ctrl.orderBy | filter: { point: { name: ctrl.search.params.text } } | unique: 'point.name' | slice: ctrl.search.meta.startPos:ctrl.search.meta.startPos+ctrl.search.meta.perPage">
                                <button class="btn btn-link collapsed" ng-click="ctrl.addPairToClient(model_label.point)" ng-if="!model_label.point._delete && (ctrl.client | valPresent) && (ctrl.client.scan_session_id | valPresent)">
                                    <img src="{{asset('/images/scan-btn-add.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                                </button>
                                <button class="btn btn-link collapsed" ng-click="ctrl.removePairToClient(model_label.point)" ng-if="model_label.point._delete && (ctrl.client | valPresent) && (ctrl.client.scan_session_id | valPresent)">
                                    <img src="{{asset('/images/scan-btn-minus.png')}}" alt="{{ env('APP_TITLE') }}"></img>
                                </button>
                                <span class="btn-link" data-toggle="collapse" data-target="#collapse-<% model_label.id %>" aria-expanded="true" aria-controls="collapse-<% model_label.id %>" ng-click="ctrl.showPoints($event, model_label.id)"><% ctrl.getPairName(model_label.point)  || '-' %></span>
                                <div id="collapse-<% model_label.id %>" class="collapse" aria-labelledby="heading-<% model_label.id %>" data-parent="#accordion" style="font-size: 16px;">
                                    <table style="margin-left: 50px; margin-top: 10px; width: calc(100% - 50px);" border="1">
                                        <thead></thead>
                                        <tbody>
                                            @if(Auth::user()->isAdmin())
                                                <tr ng-repeat="label in ctrl.model_labels | orderBy: ctrl.orderBy | filter: { point: { id: model_label.point.id, name: model_label.point.name } } track by label.id" ng-if="!(ctrl.client | valPresent)">
                                                    <td colspan="2">
                                                        <span>
                                                            X: <input type="text" ng-value="label.point_x" disabled="" style="width: 60px; max-width: 120px;">
                                                            Y: <input type="text" ng-value="label.point_y" disabled="" style="width: 60px; max-width: 120px;">
                                                            Z: <input type="text" ng-value="label.point_z" disabled="" style="width: 60px; max-width: 120px;">
                                                        </span>
                                                        <div style="float: right;">
                                                            <button class="get-coordinates" ng-click="ctrl.getCoordinates($event, label.id)">Get Coordinates</button>
                                                            <button class="editor-edit" data-toggle="modal" data-target="#modelLabelModal" data-title="Edit Model Label" data-id="<% label.id %>">Edit</button>
                                                            <button class="editor-remove" ng-click="ctrl.deletePair($event, label.id)">Delete</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>Points/Name:</td>
                                                <td><% model_label.point.name || '-' %></td>
                                            </tr>
                                            <tr>
                                                <td>Radical:</td>
                                                <td><% model_label.point.radical || '-' %></td>
                                            </tr>
                                            <tr>
                                                <td>Start/Origin:</td>
                                                <td><% model_label.point.origins || '-' %></td>
                                            </tr>
                                            <tr>
                                                <td>Leads/Symptoms:</td>
                                                <td><% model_label.point.symptoms || '-' %></td>
                                            </tr>
                                            <tr>
                                                <td>Path/Route/Cause and Effect:</td>
                                                <td><% model_label.point.paths || '-' %></td>
                                            </tr>
                                            <tr>
                                                <td>Alternative Routes:</td>
                                                <td><% model_label.point.alternative_routes || '-' %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <!-- Model Label Modal -->
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
                <input type="hidden" id="scan_type" name="scan_type">
                <input type="hidden" id="target" name="target">
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
    <script>
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
                    }
                });
            } else {
                $('#model_label_id').val('');
                $('#target').val($('#modelTarget').data('value'));
                $('#scan_type').val($('#scanType').data('value'));
                $('#pair_id').val(null);
                $('#point_x').val($('#pointX').data('value') || 0);
                $('#point_y').val($('#pointY').data('value') || 0);
                $('#point_z').val($('#pointZ').data('value') || 0);
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
    </script>
@stop
