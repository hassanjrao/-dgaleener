@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Playlists'}}
@stop
@section('content')
    @include('partials.header', ['title' => 'Add Media to Playlists'])
    <div id="content-container" style="margin-top:30px;">
        <form method="POST" id="mediaPlaylistForm" action="{{url('/mediaplaylist')}}">
            @csrf
            <input type="hidden" id="playlist_id" name="playlist_id" value="{{$playlist_id}}" />
            <input type="hidden"  name="redirect_url" value="playlist" />
            <div class="row form-group col-md-12">
                <div class="col-md-5">
                    <label>{{ __('All media files in the system:') }}</label>
                    <select multiple="multiple" id='listBox1' class="form-control" style="height:300px;">
                        @foreach($all_media as $key1 => $val2)
                            <option value="{{$key1}}">{{$val2}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 text-center" style="margin-top:130px;">
                    <button type="button" id="btnRight" class="btn btn-primary fa fa-arrow-circle-right"></button><br/><br/>
                    <button type="button" id="btnLeft" class="btn btn-primary fa fa-arrow-circle-left" ></button>
                </div>
                <div class="col-md-5">
                    <label>{{ __('Assigned media to playlist:') }}</label>
                    <select multiple="multiple" id='listBox2' class="form-control" name="media_ids[]" style="height:300px;">
                        @foreach($assigned_media as $key2 => $val2)
                            <option value="{{$key2}}">{{$val2}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
            <center><button id="mediaPlaylistSave" type="button" onClick="saveToPlaylist()" class="btn-lg btn-primary save-btn">{{ __('Save to Playlist') }}</button></center>
        </form>
    </div>
@endsection

@section('javascripts')
    @parent
    <script src="{{ asset('js/jquery.selectlistactions.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        function saveToPlaylist(){
            $('#listBox2 option').prop('selected', true);
            $("#mediaPlaylistForm").submit();
        }

        $(document).ready(function() {
            $('#btnRight').click(function (e) {
                var selectedOpts = $('#listBox1 option:selected');
                if (selectedOpts.length == 0) {
                    alert("Nothing to move.");
                    e.preventDefault();
                }
                $('#listBox2').append($(selectedOpts).clone());
                $(selectedOpts).remove();
                e.preventDefault();
            });

            $('#btnLeft').click(function (e) {
                var selectedOpts = $('#listBox2 option:selected');
                if (selectedOpts.length == 0) {
                    alert("Nothing to move.");
                    e.preventDefault();
                }
                $('#listBox1').append($(selectedOpts).clone());
                $(selectedOpts).remove();
                e.preventDefault();
            });
        });
    </script>
@stop
