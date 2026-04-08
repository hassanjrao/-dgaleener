@extends('layouts.application')
@section('page-title')
    {{ 'Anew Avenue Biomagnestim | Blog Posts' }}
@stop
@section('styles')
    @parent
@stop
@section('content')
    @include('partials.header', ['title' => ''])

    <div class="container">
        <h2>
            {{ __('Blog Posts') }} 
            <a href="{{ route('app.posts.new') }}"><button class="editor-new fa fa-plus"></button></a>
        </h2><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="posts" >
                <thead>
                    <tr>
                        <th class="align-center" style="width: 5%;">{{ __('ID') }}</th>
                        <th class="align-left" style="width: 45%;">{{ __('Title') }}</th>
                        <th class="align-left" style="width: 30%;">{{ __('Slug') }}</th>
                        <th class="align-left" style="width: 5%;">{{ __('Published') }}</th>
                        <th class="align-left" style="width: 15%;">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            // Delete a record
            $('#posts').on('click', 'button.editor-remove', function (e) {
                e.preventDefault();

                $post_id = $(this).attr('data-id')

                var confirmDialog = confirm("Are you sure you wish to delete this post?");
                if (confirmDialog == true) {
                    $.ajax({
                        url: '/posts/'+$post_id,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                }
            } );

            $('#posts').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '/posts/datatables' },
                columns: [
                    { data: 'id', name: 'id', className: 'dt-body-center' },
                    { data: 'post_title', name: 'post_title' },
                    { data: 'post_slug', name: 'post_slug' },
                    {
                        data: 'isPublished',
                        className: "dt-body-center",
                        orderable: false,
                        render: function ( data, type, row, meta ) {
                            if (data == null) {
                                return 'No';
                            } else {
                                return 'Yes';
                            }
                        }
                    },
                    {
                        data: 'id',
                        className: "dt-body-center",
                        orderable: false,
                        render: function ( data, type, row, meta ) {
                            return '<button class="editor-remove fa fa-trash-o fa-2x" style="color: red;" data-id="'+data+'"></button><a href="/posts/'+data+'/edit"><button class="editor-edit fa fa-edit fa-2x" data-toggle="modal" data-target="#postModal" data-title="Edit Post" data-id="'+data+'"></button></a><a href="/posts/'+data+'"><button class="editor-edit fa fa-eye fa-2x"></button></a>';
                        }
                    }
                ]
            });
        });
    </script>
@stop
