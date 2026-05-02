@extends('layouts.admin')
@section('page-title')
    {{ __('Anew Avenue Biomagnestim | Administrator - Playlists') }}
@stop
@section('styles')
    @parent
@stop
@section('content')
    <div id="content-container" style="margin-top:30px;">
        <div class="row col-md-12">
            <div class="col-md-10">
                <h5>{{ __('Available Playlists') }}</h5>
            </div>
            <div class="col-md-2">
                <button class="btn btn-lg btn-primary fa fa-plus" data-toggle="modal" data-target="#playlistModal" data-title="New Playlist">&nbsp;&nbsp;{{ __('Create New Playlist') }}</button>
            </div>
        </div><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="playlists">
                <thead>
                    <tr>
                        <th class="align-center">{{ __('Name') }}</th>
                        <th class="align-center">{{ __('Description') }}</th>
                        <th class="align-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Edit Playlist Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle"> {{ __('Update Playlist') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="updatePlaylistForm">
                @csrf
                <input type="hidden" id="playlist_id" name="id" value="" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="play_name" name="name" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea class="form-control" id="play_description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button id="updatePlaylistSave" type="button" class="btn btn-primary save-btn">{{ __('Save') }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Delete Playlist Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle"> {{ __('Remove Playlist') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" id="deletePlaylistForm">
                @csrf
                <input type="hidden" id="deleteUrl" value="">
                <div class="modal-body">
                    <h5>Are you sure you want to continue to remove this playlist and all its contents? </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button id="deletePlaylistSave" type="button" class="btn btn-danger save-btn">{{ __('Remove') }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- New Playlist Modal -->
    <div class="modal fade" id="playlistModal" tabindex="-1" role="dialog" aria-labelledby="playlistModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playlistModalTitle"> {{ __('New Playlist') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="newPlaylistForm" action="{{ url('/admin/playlist') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{ __('Playlist Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button id="playlistSave" type="submit" class="btn btn-primary save-btn">{{ __('Save') }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- List to Playlist Modal -->
    <div class="modal fade" id="playerModal" tabindex="-1" role="dialog" aria-labelledby="playerModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="playerModalTitle"> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="jquery_jplayer_2" class="jp-jplayer"></div>
                    <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player">
                        <div class="jp-type-playlist">
                            <div class="jp-gui jp-interface">
                                <div class="jp-controls">
                                    <button class="jp-previous" role="button" tabindex="0">previous</button>
                                    <button class="jp-play" role="button" tabindex="0">play</button>
                                    <button class="jp-next" role="button" tabindex="0">next</button>
                                    <button class="jp-stop" role="button" tabindex="0">stop</button>
                                </div>
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                                <div class="jp-volume-controls">
                                    <button class="jp-mute" role="button" tabindex="0">mute</button>
                                    <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                    <div class="jp-volume-bar">
                                        <div class="jp-volume-bar-value"></div>
                                    </div>
                                </div>
                                <div class="jp-time-holder">
                                    <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                    <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                </div>
                                <div class="jp-toggles">
                                    <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                    <button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
                                </div>
                            </div>
                            <div class="jp-playlist">
                                <ul>
                                    <li>&nbsp;</li>
                                </ul>
                            </div>
                            <div class="jp-no-solution">
                                <span>Update Required</span>
                                To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
    <script src="{{ asset('/js/jquery.jplayer.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/jplayer.playlist.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        function editPlaylist(id){
            $.ajax({
                url: '/playlist/'+id,
                type: 'GET',
                success: function(result) {
                    $('#playlist_id').val(result.id);
                    $('#play_name').val(result.name);
                    $('#play_description').val(result.description != null ? String(result.description) : '');
                }
            });
        }
        function deletePlaylist(id){
            var durl = '{{ url("/admin/playlist/delete")}}'+'/'+id;
            $("#deleteUrl").val(durl);
        }
        function listenPlaylist(id, name){
            $("#playerModalTitle").html(name);
            var get_mediaurl= '{{ url("/admin/playlist/media/")}}'+'/'+id;
            $.ajax({
                url: get_mediaurl,
                dataType: 'json'
            }).done(function(data){
                if (Array.isArray(data) && data.length > 0) {
                    new jPlayerPlaylist({
                        jPlayer: "#jquery_jplayer_2",
                        cssSelectorAncestor: "#jp_container_2"
                    },
                    data, 
                    {
                        swfPath: "../../dist/jplayer",
                        supplied: "mp3",
                        wmode: "window",
                        useStateClassSkin: true,
                        autoBlur: true,
                        smoothPlayBar: true,
                        keyEnabled: true
                    });
                    $('#playerModal').modal('show');
                } else {
                    alert('No playable media files were found for this playlist.');
                }
            }).fail(function(xhr){
                console.error('Unable to load playlist media.', xhr);
                alert('Unable to load playlist media right now.');
            });
        }

        $(document).ready(function() {
            //update media details
            $("#updatePlaylistSave").click(function(e) {
                var formData = $("#updatePlaylistForm").serialize();
                var id       = $("#playlist_id").val();
                var url      = '{{ url("/admin/playlist/update")}}'+'/'+id;
                $("#updatePlaylistForm").attr("action",url);
                $("#updatePlaylistForm").submit();
            });

            //delete media details
            $("#deletePlaylistSave").click(function(e) {
                var url = $("#deleteUrl").val();
                $("#deletePlaylistForm").attr("action",url);
                $("#deletePlaylistForm").submit();
            });

            $('#playlists').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ url("/admin/playlist/datatables") }}' },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action', orderable:false, searchable: false}
                ]
            });

            $("#playerModal").on('hidden.bs.modal', function(e){
                $(this).removeData('bs.modal');
                $("#jquery_jplayer_2").jPlayer("destroy");
            });
        });
    </script>
@stop
