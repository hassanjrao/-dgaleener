@extends('layouts.admin')
@section('page-title')
    {{ __('Anew Avenue Biomagnestim | Administrator - Subscriptions') }}
@stop
@section('styles')
    @parent
@stop
@section('content')
    @csrf
    <div id="content-container">
        <h2>
            {{ $user->name." | ".__('Subscriptions') }}
            <button class="editor-new fa fa-plus" data-toggle="modal" data-target="#subscriptionModal" data-title="New Subscription"></button>
        </h2><br/>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="subscriptions" >
                <thead>
                    <tr>
                        <th class="align-center">{{ __('ID') }}</th>
                        <th class="align-left">{{ __('Plan') }}</th>
                        <th class="align-left">{{ __('Starts At') }}</th>
                        <th class="align-left">{{ __('Ends At') }}</th>
                        <th class="align-left">{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="subscriptionModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subscriptionModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
            <div class="modal-body">
                <input type="hidden" id="subscription_id" name="subscription_id">
                <input type="hidden" id="user_id" name="user_id">
                <div class="form-group">
                    <label for="type">Plan</label>
                    <select class="form-control" id="plan_id" name="plan_id" required>
                    <option value="null"></option>
                    @foreach(\App\Models\Plan::orderBy('name', 'asc')->get() as $plan)
                        <option value="{{$plan->id}}">{{ucfirst($plan->name).' ($'.number_format($plan->price, 2).')'}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="starts_at">
                    <label for="starts_at">Starts At</label>
                    <input type="date" class="form-control" id="starts_at" name="starts_at" placeholder="Starts At">
                </div>
                <div class="form-group">
                    <label for="ends_at">Ends At</label>
                    <input type="date" class="form-control" id="ends_at" name="ends_at" placeholder="Ends At">
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
            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            }

            // New record
            $('#subscriptions').on('click', 'button.editor-new', function (e) {
                e.preventDefault();
            } );

            // Edit record
            $('#subscriptionModal').on('show.bs.modal', function (e) {
                var trigger = $(e.relatedTarget)
                $('#subscriptionModalTitle').text(trigger.data('title'));

                // Retrieve subscription 
                $subscription_id = trigger.data('id')

                if ($subscription_id) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/{{$user->id}}/subscriptions/'+$subscription_id,
                        type: 'GET',
                        success: function(result) {
                            $('#subscription_id').val($subscription_id)
                            $('#user_id').val(result.user_id);
                            $('#starts_at').val(formatDate(result.starts_at));
                            $('#ends_at').val(formatDate(result.ends_at));
                            $('#plan_id').val(result.plan_id);
                        }
                    });
                } else {
                    $('#subscription_id').val(null)
                    $('#user_id').val(null)
                    $('#starts_at').val(null)
                    $('#ends_at').val(null)
                    $('#plan_id').val(null)
                }
            })

            // Save a record
            $(".save-btn").click(function(e){
                e.preventDefault();

                var $subscription_id = $('#subscription_id').val()

                var data = {
                    user_id: $("#user_id").val(),
                    plan_id: $("#plan_id").val(),
                    starts_at: $("#starts_at").val(),
                    ends_at: $("#ends_at").val()
                };

                if ($subscription_id) {
                    request = {
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/{{$user->id}}/subscriptions/'+$subscription_id,
                        method: 'PUT'
                    }
                } else {
                    request = {
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/{{$user->id}}/subscriptions',
                        method: 'POST'
                    }
                }

                $.ajax({
                    url: request.url,
                    type: request.method,
                    data: data,
                    dataType: 'JSON',
                    success: function (data) { 
                        location.reload();
                    }
                }); 
            });
        
            // Delete a record
            $('#subscriptions').on('click', 'button.editor-remove', function (e) {
                e.preventDefault();

                $subscription_id = $(this).attr('data-id')

                var confirmDialog = confirm("Are you sure you wish to delete this subscription?");
                if (confirmDialog == true) {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/{{$user->id}}/subscriptions/'+$subscription_id,
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                }
            } );

            $('#subscriptions').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/users/{{$user->id}}/subscriptions/datatables' },
                columns: [
                    { data: 'id', name: 'id', className: 'dt-body-center' },
                    { data: 'plan', orderable: false, searchable: false,
                        render: function ( data, type, row, meta ) {
                            return data.name + " ($" + parseFloat(Math.round(data.price * 100) / 100).toFixed(2)  + ")"
                        }
                    },
                    { data: 'starts_at', 
                        render: function ( data, type, row, meta ) {
                            return new Date(data).toLocaleString();
                        }
                    },
                    { data: 'ends_at', 
                        render: function ( data, type, row, meta ) {
                            return new Date(data).toLocaleString();
                        }
                    },
                    {
                        data: 'id',
                        className: "dt-body-center",
                        "orderable": false,
                        render: function ( data, type, row, meta ) {
                            return '<button class="editor-remove fa fa-trash-o fa-2x" style="color: red;" data-id="'+data+'"></button><button class="editor-edit fa fa-edit fa-2x" data-toggle="modal" data-target="#subscriptionModal" data-title="Edit Subscription" data-id="'+data+'"></button>';
                        }
                    }
                ]
            });
        });
    </script>
@stop
