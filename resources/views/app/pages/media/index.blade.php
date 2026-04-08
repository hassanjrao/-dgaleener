@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Media Files'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'Media Uploads'])
    <div id="content-container" style="margin: 50px;">
        <div class="row col-md-12">
            <div class="col-md-8">
                <h5>{{ __('Available Media Files') }}</h5>
            </div>
            <div class="col-md-4">
                <button class="btn btn-lg btn-primary fa fa-plus" data-toggle="modal" data-target="#mediaModal" data-title="New Media File">&nbsp;&nbsp;{{ __('Upload New Media') }}</button>
                @if(Auth::user()->isPractitioner())
                    <button class="btn btn-lg btn-primary fa fa-plus" data-toggle="modal" data-target="#playlistModal" data-title="New Playlist">&nbsp;&nbsp;{{ __('Create New Playlist') }}</button>
                @endif
            </div>
        </div><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="media">
                <thead>
                    <tr>
                        <th class="align-center" style="width:30%">{{ __('File Name') }}</th>
                        <th class="align-center" style="width:50%">{{ __('Description') }}</th>
                        <th class="align-center" style="width:20%">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- New Media File Modal -->
    <div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediaModalTitle"> {{ __('New Media File') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="loader-part" style="display:none;">
                    <div class="modal-body">
                        <br/><br/><div class="loader" style="margin-left:150px;"></div><br/>
                        <p style="text-align:center">{{ __('Please wait... file upload is still being processed...') }}</p><br/>
                    </div>
                </div>
                <div id="form-part">
                    <form method="POST" enctype="multipart/form-data" id="newMediaForm" action='{{ url("/media") }}'>
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">{{ __('File') }}</label>
                                <input type="file" name="media_file" id="fileToUpload" class="form-control" accept=".mp3,audio/*">
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                            <button id="mediaSave" type="submit" class="btn btn-primary save-btn">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Media File Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle"> {{ __('Update Media Details') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="updateMediaForm">
                @csrf
                <input type="hidden" id="media_id" name="id" value="" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{ __('File Name') }}</label>
                        <input type="text" class="form-control" id="media_file_name" name="file_name" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea class="form-control" id="media_description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button id="updateMediaSave" type="button" class="btn btn-primary save-btn">{{ __('Save') }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Delete Media File Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle"> {{ __('Remove Media File') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" id="deleteMediaForm">
                @csrf
                <input type="hidden" id="deleteUrl" value="">
                <div class="modal-body">
                    <h5>Are you sure you want to continue to remove this media file and all its contents? </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button id="deleteMediaSave" type="button" class="btn btn-danger save-btn">{{ __('Remove') }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Add media to playlist -->
    <div class="modal fade" id="comsModal" tabindex="-1" role="dialog" aria-labelledby="comsModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comsModalTitle"> {{ __('Add Media to Playlist') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="comsForm" action="{{ url('/mediaplaylist') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="redirect_url" name="redirect_url" value="" />
                    <div class="form-group">
                        <label for="name">{{ __('Media File') }}</label>
                        <input type="hidden" id="media_file_id" name="media_id" value="" />
                        <input type="text" class="form-control" id="media_file" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Playlist') }}</label>
                        <select name="playlist_id" class="form-control">
                            <option value="0">Select</option>
                            @foreach($playlists as $playlist)
                                <option value="{{ $playlist['id'] }}">{{ $playlist['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button id="addMediaPlaylistSave" type="submit" class="btn btn-primary save-btn">{{ __('Save') }}</button>
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
            <form method="POST" id="newPlaylistForm" action="{{ url('/playlist') }}">
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

    <!-- Player Modal-->
    <div class="modal fade" id="playerModal" tabindex="-1" role="dialog" aria-labelledby="playerModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playerModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
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
    <script src="{{ asset('js/jquery.jplayer.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jplayer.playlist.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript">
        function playFile(filename, s3file){
            $("#playerModalTitle").html(filename);
            var myPlaylist = new jPlayerPlaylist({
                    jPlayer: "#jquery_jplayer_2",
                    cssSelectorAncestor: "#jp_container_2"
                }, [
                {
                    title: filename,
                    mp3: s3file
                }
                ], {
                playlistOptions: {
                    enableRemoveControls: false
                },
                swfPath: "../../dist/jplayer",
                supplied: "mp3",
                wmode: "window",
                useStateClassSkin: true,
                autoBlur: true,
                smoothPlayBar: true,
                keyEnabled: true
            });
        }

        function editMedia(id){
            $.ajax({
                url: '/media/'+id,
                type: 'GET',
                success: function(result) {
                    $('#media_id').val(result.id);
                    $('#media_file_name').val(result.file_name);
                    $('#media_description').val(result.description != null ? String(result.description) : '');
                }
            });
        }
        
        function deleteMedia(id){
            var durl = '{{ url("/media/delete")}}'+'/'+id;
            $("#deleteUrl").val(durl);
        }
        function addToPlaylist(id, filename, redirect){
            $("#media_file_id").val(id);
            $("#media_file").val(filename);
            $("#redirect_url").val(redirect);
        }

        $(document).ready(function() {
            //submit new media
            $("#mediaSave").click(function(e) {
                $('#form-part').hide();
                $('#loader-part').show();
            });

            //update media details
            $("#updateMediaSave").click(function(e) {
                var formData = $("#updateMediaForm").serialize();
                var id       = $("#media_id").val();
                var url      = '{{ url("/media/update")}}'+'/'+id;
                $("#updateMediaForm").attr("action",url);
                $("#updateMediaForm").submit();
            });

            //delete media details
            $("#deleteMediaSave").click(function(e) {
                var url = $("#deleteUrl").val();
                $("#deleteMediaForm").attr("action",url);
                $("#deleteMediaForm").submit();
            });

            $('#media').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ url("/media/datatables") }}' },
                columns: [
                    { data: 'file_name', name: 'file_name' },
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
