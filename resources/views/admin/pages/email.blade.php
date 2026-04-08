@extends('layouts.admin')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Administrator'}}
@stop
@section('styles')
    @parent

    <style>
        .control-label {
            font-weight: 600;
            font-size: 18px;
        }

        .form-group span {
            margin-left: 35px;
        }

        .loader-part {
            margin: 0 auto;
        }
    </style>
@stop
@section('content')
    <div id="content-container">
        <h3>Compose Email</h3>
        <hr>
        <div id="loader-part" style="display: none;">
            <br/><br/><div class="loader" style="margin:0 auto;"></div><br/>
            <p style="text-align:center">{{ __('Please wait... sending email is still being processed...') }}</p><br/>
        </div>
        <div class="row" id="form-part">
            <div class="col-md-12">
                <form name="emailForm">
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="name">Recipients</label>
                        <div class="col-md-12">
                            <input class="form-control" id="recipients" name="recipients" type="text" placeholder="" required="true">
                        </div>
                        <span>(seperate emails using semicolons - for example: person1.gmail.com; person2.gmail.com; person3.gmail.com)</span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="subject">Subject</label>
                        <div class="col-md-12">
                            <input class="form-control" id="subject" name="subject" type="text" placeholder="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="content">Content</label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="content" name="content" type="text" placeholder="" required="true"></textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                        <button type="submit" id="send" class="btn btn-primary pull-right">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        $( document ).ready(function() {
            var editor_config = {
                path_absolute : "/",
                selector: "textarea",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file : cmsURL,
                        title : 'Filemanager',
                        width : x * 0.8,
                        height : y * 0.8,
                        resizable : "yes",
                        close_previous : "no"
                    });
                }
            };

            tinymce.init(editor_config);

            $( "#send" ).click(function(ev) {
                ev.preventDefault()

                data = {
                    recipients: $('#recipients').val(),
                    subject: $('#subject').val(),
                    content: tinyMCE.get('content').getContent()
                }

                if (data.recipients == '' || data.recipients == null) {
                    alert('Recipients must be filled out.')
                    $("#recipients").focus();
                } else if (data.subject == '' || data.subject == null) {
                    alert('Subject must be filled out.')
                    $("#subject").focus();
                } else if (data.content == '' || data.content == null) {
                    alert('Content must be filled out.')
                    $("#content").focus();
                } else {
                    $('#form-part').hide();
                    $('#loader-part').show();

                    $.ajax({
                        url: "{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/admin/mail",
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        success: function (data) { 
                            location.reload();
                        }
                    });
                }
            });
        });

    </script>
@stop
