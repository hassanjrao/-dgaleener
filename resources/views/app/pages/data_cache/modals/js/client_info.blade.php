<script type="text/javascript">
    $(document).ready(function() {
        $('#clients').DataTable({
            processing: true,
            serverSide: true,
            ajax: { url : '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/clients/datatables?user_id={{ Auth::user()->id }}' },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email' },
                { data: 'address', name: 'address' },
                { data: 'phone_no', name: 'phone_no' },
                { data: 'date_of_birth', name: 'date_of_birth' },
                { data: 'age', name: 'age', searchable: false, sortable: false },
                { data: 'emergencyDetails', name: 'emergencyDetails', searchable: false, sortable: false },
                { data: 'sessionDetails', name: 'sessionDetails', searchable: false, sortable: false },
                {
                    data: 'id',
                    className: "dt-body-center",
                    "orderable": false,
                    render: function ( data, type, row, meta ) {
                        return '<button class="editor_show fa fa-eye" data-id="'+data+'"></button><button class="editor-edit fa fa-edit" data-toggle="modal" data-target="#clientInfoModal" data-title="Edit Client" data-id="'+data+'"></button><button class="editor-remove fa fa-trash-o"data-id="'+data+'"></button>';
                    }
                }
            ]
        });

        // Edit record
        $('#clientInfoModal').on('show.bs.modal', function (e) {
            var trigger = $(e.relatedTarget)
            $('#clientInfoModalTitle').text(trigger.data('title'));

            // Retrieve client 
            $client_id = trigger.data('id')

            if (trigger.data('mode') != undefined) {
                $mode = trigger.data('mode')
                $('#mode').val($mode);
            }

            if ($client_id != null) {
                $(".clear-btn").css("display", "none") 
            } else {
                $(".clear-btn").css("display", "initial") 
            }

            if ($client_id != undefined) {
                $.ajax({
                    url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/clients/'+$client_id,
                    type: 'GET',
                    success: function(result) {
                        $('#client_id').val(result.id);
                        $('#first_name').val(result.first_name);
                        $('#last_name').val(result.last_name);
                        $('#email').val(result.email);
                        $('#address').val(result.address);
                        $('#phone_no').val(result.phone_no);
                        $('#date_of_birth').val(result.date_of_birth),
                        $('#emergency_contact_person').val(result.emergency_contact_person);
                        $('#emergency_contact_number').val(result.emergency_contact_number);
                        $('#session_cost_type').val(result.session_cost_type);
                        $('#session_cost').val(result.session_cost);
                        $('#gender').val(result.gender);
                        if (result.session_paid == 1) {
                            $('#session_paid').prop('checked', true);
                        } else {
                            $('#session_paid').prop('checked', false);
                        }
                    }
                });
            }
        })

        $(".clear-btn").click(function(e){
            e.preventDefault();

            $("#first_name").val(null)
            $("#last_name").val(null)
            $("#email").val(null)
            $("#address").val(null)
            $('#phone_no').val(null)
            $('#date_of_birth').val(null)
            $('#emergency_contact_person').val(null)
            $('#emergency_contact_number').val(null)
            $('#session_cost_type').val(null)
            $('#session_cost').val(null)
            $('#session_paid').prop('checked', false);
            $('#gender').val(null)
        });

        // Save a record
        $(".save-btn:not(#submit_pref)").click(function(e){
            e.preventDefault();

            var $client_id = $('#client_id').val()
            var $user_id = $('#user_id').val()

            var session_paid;
            if ($('#session_paid').is(":checked")){
                session_paid = 1
            } else {
                session_paid = 0
            }

            var data = {
                user_id: parseInt($user_id),
                first_name: $("#first_name").val(),
                last_name: $("#last_name").val(),
                email: $("#email").val(),
                address: $("#address").val(),
                phone_no: $("#phone_no").val(),
                date_of_birth: $('#date_of_birth').val(),
                emergency_contact_person: $("#emergency_contact_person").val(),
                emergency_contact_number: $("#emergency_contact_number").val(),
                session_cost_type: $("#session_cost_type").val(),
                session_cost: parseFloat($("#session_cost").val()),
                session_paid: session_paid,
                gender: $("#gender").val()
            };

            if ($("#first_name").val() == '' || $("#first_name").val() == null) {
                alert('First Name must be filled out.')
                $("#first_name").focus()
            } else if ($("#last_name").val() == '' || $("#last_name").val() == null) {
                alert('Last Name must be filled out.')
                $("#last_name").focus()
            } else if ($("#email").val() == '' || $("#email").val() == null) {
                alert('Email must be filled out.')
                $("#email").focus()
            } else if ($("#address").val() == '' || $("#address").val() == null) {
                alert('Address must be filled out.')
                $("#address").focus()
            } else if ($("#gender").val() == '' || $("#gender").val() == null) {
                alert('Gender must be filled out.')
                $("#gender").focus()
            } else if ($("#phone_no").val() == '' || $("#phone_no").val() == null) {
                alert('Phone Number must be filled out.')
                $("#phone_no").focus()
            } else if ($("#emergency_contact_person").val() == '' || $("#emergency_contact_person").val() == null) {
                alert('Emergency Contact Person must be filled out.')
                $("#emergency_contact_person").focus()
            } else if ($("#emergency_contact_number").val() == '' || $("#emergency_contact_number").val() == null) {
                alert('Emergency Contact Phone Number must be filled out.')
                $("#emergency_contact_number").focus()
            } else if ($("#date_of_birth").val() == '' || $("#date_of_birth").val() == null) {
                alert('Date of birth must be filled out.')
                $("#date_of_birth").focus()
            } else if ($("#session_cost_type").val() == '' || $("#session_cost_type").val() == null) {
                alert('Session Cost Type must be filled out.')
                $("#session_cost_type").focus()
            } else if ($("#session_cost").val() == '' || $("#session_cost").val() == null) {
                alert('Session Cost must be filled out.')
                $("#session_cost").focus()
            } else {
                if ($client_id != undefined && $client_id != '') {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/clients/'+$client_id,
                        type: 'PUT',
                        data: data,
                        dataType: 'JSON',
                        success: function (data) { 
                            location.reload();
                        }
                    });
                } else {
                    $.ajax({
                        url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/clients',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        success: function (data) { 
                            if ($("#mode").val() == 'bio' || $("#mode").val() == 'chakra') {
                                window.location.href = "/data_cache/clients/"+data.id
                            } else {
                                location.reload();
                            }
                        }
                    });
                }
            }
        });

        // Delete a record
        $('#clients').on('click', 'button.editor-remove', function (e) {
            e.preventDefault();

            $client_id = $(this).attr('data-id')

            var confirmDialog = confirm("Are you sure you wish to delete this client?");
            if (confirmDialog == true) {
                $.ajax({
                    url: '{{ env("APP_WEB_API_URL") }}/{{ env("APP_WEB_API_VERSION" )}}/clients/'+$client_id,
                    type: 'DELETE',
                    success: function(result) {
                        location.reload();
                    }
                });
            }
        } );

        $('#clients').on('click', 'button.editor_show', function (e) {
            e.preventDefault();

            $client_id = $(this).attr('data-id')

            window.location.href = '/data_cache/clients/' + $client_id
        } );
    });
</script>
