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

        .email-help-text {
            display: block;
            margin-top: 8px;
            color: #6b7280;
        }

        .email-feedback {
            display: none;
            margin-bottom: 20px;
        }

        .recipient-editor {
            align-items: center;
            background: #fff;
            border: 1px solid #ced4da;
            border-radius: 4px;
            cursor: text;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            min-height: 46px;
            padding: 6px 10px;
        }

        .recipient-editor.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
        }

        .recipient-chip {
            align-items: center;
            background: #e8f1ff;
            border: 1px solid #b8d3ff;
            border-radius: 999px;
            color: #174ea6;
            display: inline-flex;
            font-size: 13px;
            gap: 6px;
            line-height: 1;
            padding: 7px 10px;
        }

        #recipient-chip-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .recipient-chip-remove {
            background: transparent;
            border: 0;
            color: inherit;
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
            padding: 0;
        }

        .recipient-input {
            border: 0;
            box-shadow: none;
            flex: 1 1 220px;
            min-width: 220px;
            outline: 0;
            padding: 4px 0;
        }

        .email-send-row {
            display: flex;
            justify-content: flex-end;
        }

        .email-send-btn {
            min-width: 110px;
            position: relative;
        }

        .email-send-btn.is-loading {
            pointer-events: none;
        }

        .email-send-btn-spinner {
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-top-color: #fff;
            border-radius: 50%;
            display: none;
            height: 16px;
            margin-right: 8px;
            vertical-align: text-bottom;
            width: 16px;
            animation: email-spin 0.7s linear infinite;
        }

        .email-send-btn.is-loading .email-send-btn-spinner {
            display: inline-block;
        }

        #content {
            min-height: 220px;
        }

        @keyframes email-spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
@stop
@section('content')
    <div id="content-container">
        <h3>Compose Email</h3>
        <hr>
        <div id="email-feedback" class="alert email-feedback" role="alert"></div>
        <div class="row" id="form-part">
            <div class="col-md-12">
                <form name="emailForm">
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="name">Recipients</label>
                        <div class="col-md-12">
                            <div class="recipient-editor" id="recipient-editor">
                                <div id="recipient-chip-list"></div>
                                <input class="recipient-input" id="recipient-input" type="text" placeholder="Type an email and end with ;">
                            </div>
                            <input id="recipients" name="recipients" type="hidden">
                        </div>
                        <span class="email-help-text">(separate emails using semicolons - for example: person1@gmail.com; person2@gmail.com; person3@gmail.com)</span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="subject">Subject</label>
                        <div class="col-md-12">
                            <input class="form-control" id="subject" name="subject" type="text" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="content">Content</label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="content" name="content" type="text" required="true"></textarea>
                        </div>
                        <span class="email-help-text">Plain text is supported. Basic HTML also works if you type it directly.</span>
                    </div>
                    <div class="form-group email-send-row">
                        <button type="submit" id="send" class="btn btn-primary email-send-btn">
                            <span class="email-send-btn-spinner" aria-hidden="true"></span>
                            <span class="email-send-btn-label">Send</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent

    <script>
        $( document ).ready(function() {
            var recipients = [];
            var $feedback = $('#email-feedback');
            var $recipientEditor = $('#recipient-editor');
            var $recipientInput = $('#recipient-input');
            var $recipientList = $('#recipient-chip-list');
            var $recipientField = $('#recipients');
            var $sendButton = $('#send');
            var $sendButtonLabel = $('.email-send-btn-label');

            function resetFeedback() {
                $feedback.hide().removeClass('alert-success alert-danger alert-warning').empty();
                $recipientEditor.removeClass('is-invalid');
            }

            function showFeedback(type, title, items) {
                var classes = {
                    success: 'alert-success',
                    danger: 'alert-danger',
                    warning: 'alert-warning'
                };
                var html = '<strong>' + $('<div>').text(title).html() + '</strong>';

                if ($.isArray(items) && items.length) {
                    html += '<ul style="margin: 10px 0 0 20px;">';

                    $.each(items, function(_, item) {
                        html += '<li>' + $('<div>').text(item).html() + '</li>';
                    });

                    html += '</ul>';
                }

                $feedback
                    .removeClass('alert-success alert-danger alert-warning')
                    .addClass(classes[type] || 'alert-danger')
                    .html(html)
                    .show();
            }

            function setSending(isSending) {
                $sendButton.toggleClass('is-loading', isSending).prop('disabled', isSending);
                $recipientInput.prop('disabled', isSending);
                $('#subject').prop('disabled', isSending);
                $sendButtonLabel.text(isSending ? 'Sending...' : 'Send');
            }

            function normalizeRecipient(value) {
                return $.trim((value || '').replace(/[;,]+$/g, ''));
            }

            function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }

            function syncRecipients() {
                $recipientField.val(recipients.join('; '));
            }

            function renderRecipients() {
                $recipientList.empty();

                $.each(recipients, function(_, email) {
                    var $chip = $('<span class="recipient-chip"></span>');
                    var $removeButton = $('<button type="button" class="recipient-chip-remove" aria-label="Remove recipient">&times;</button>');

                    $chip.append($('<span></span>').text(email));
                    $removeButton.attr('data-email', email);
                    $chip.append($removeButton);
                    $recipientList.append($chip);
                });

                syncRecipients();
            }

            function addRecipients(values) {
                var invalidEmails = [];
                var addedAny = false;

                $.each(values, function(_, value) {
                    var email = normalizeRecipient(value);
                    var existingIndex;

                    if (!email) {
                        return;
                    }

                    if (!isValidEmail(email)) {
                        invalidEmails.push(email);
                        return;
                    }

                    existingIndex = recipients.findIndex(function(currentEmail) {
                        return currentEmail.toLowerCase() === email.toLowerCase();
                    });

                    if (existingIndex === -1) {
                        recipients.push(email);
                        addedAny = true;
                    }
                });

                if (addedAny) {
                    renderRecipients();
                }

                if (invalidEmails.length) {
                    $recipientEditor.addClass('is-invalid');
                    showFeedback('danger', 'Some recipient addresses are invalid.', invalidEmails);
                }
            }

            function commitRecipientInput(force) {
                var rawValue = $recipientInput.val();
                var hasDelimiter = /[;\n,]/.test(rawValue);
                var parts;

                if (!rawValue) {
                    return;
                }

                if (!force && !hasDelimiter) {
                    return;
                }

                parts = rawValue.split(/[;\n,]+/);

                if (!force && !/[;\n,]\s*$/.test(rawValue)) {
                    $recipientInput.val(parts.pop());
                } else {
                    $recipientInput.val('');
                }

                addRecipients(parts);
            }

            function removeRecipient(email) {
                recipients = recipients.filter(function(currentEmail) {
                    return currentEmail !== email;
                });

                renderRecipients();
            }

            function getEditorContent() {
                return $('#content').val();
            }

            function collectErrorMessages(payload) {
                var messages = [];

                if (payload && payload.responseJSON) {
                    if (payload.responseJSON.error && payload.responseJSON.error.message) {
                        messages.push(payload.responseJSON.error.message);
                    }

                    if (payload.responseJSON.error && $.isArray(payload.responseJSON.error.errors)) {
                        $.each(payload.responseJSON.error.errors, function(_, errorEntry) {
                            if (errorEntry.email && errorEntry.message) {
                                messages.push(errorEntry.email + ': ' + errorEntry.message);
                            }
                        });
                    } else if (payload.responseJSON.error && $.isPlainObject(payload.responseJSON.error.errors)) {
                        $.each(payload.responseJSON.error.errors, function(_, fieldErrors) {
                            if ($.isArray(fieldErrors)) {
                                $.each(fieldErrors, function(_, fieldError) {
                                    messages.push(fieldError);
                                });
                            }
                        });
                    }
                }

                if (messages.length === 0 && payload && payload.statusText) {
                    messages.push(payload.statusText);
                }

                if (messages.length === 0) {
                    messages.push('An unexpected error occurred while sending the email.');
                }

                return messages;
            }

            $recipientEditor.on('click', function() {
                $recipientInput.trigger('focus');
            });

            $recipientInput.on('input', function() {
                if (/[;\n,]/.test($(this).val())) {
                    resetFeedback();
                    commitRecipientInput(false);
                }
            });

            $recipientInput.on('keydown', function(event) {
                if (event.key === 'Enter' || event.key === 'Tab') {
                    event.preventDefault();
                    resetFeedback();
                    commitRecipientInput(true);
                } else if (event.key === 'Backspace' && !$recipientInput.val() && recipients.length) {
                    removeRecipient(recipients[recipients.length - 1]);
                }
            });

            $recipientInput.on('blur', function() {
                resetFeedback();
                commitRecipientInput(true);
            });

            $recipientList.on('click', '.recipient-chip-remove', function() {
                removeRecipient($(this).attr('data-email'));
            });

            $('form[name="emailForm"]').on('submit', function(event) {
                event.preventDefault();
                $('#send').trigger('click');
            });

            $( "#send" ).click(function(ev) {
                var data;
                var content;

                ev.preventDefault();
                resetFeedback();
                commitRecipientInput(true);

                content = getEditorContent();
                data = {
                    recipients: $recipientField.val(),
                    subject: $('#subject').val(),
                    content: content
                };

                if (!recipients.length) {
                    $recipientEditor.addClass('is-invalid');
                    showFeedback('danger', 'Recipients must be filled out.');
                    $recipientInput.focus();
                } else if (data.subject == '' || data.subject == null) {
                    showFeedback('danger', 'Subject must be filled out.');
                    $("#subject").focus();
                } else if (data.content == '' || data.content == null) {
                    showFeedback('danger', 'Content must be filled out.');
                    $("#content").focus();
                } else {
                    setSending(true);

                    $.ajax({
                        url: "{{ url('/admin/email/send') }}",
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        success: function (response) {
                            var failedMessages = [];

                            if (response && response.data && $.isArray(response.data.failed)) {
                                $.each(response.data.failed, function(_, failedRecipient) {
                                    if (failedRecipient.email && failedRecipient.message) {
                                        failedMessages.push(failedRecipient.email + ': ' + failedRecipient.message);
                                    }
                                });
                            }

                            if (failedMessages.length) {
                                showFeedback('warning', response.message || 'Email sent to some recipients.', failedMessages);
                            } else {
                                showFeedback('success', response.message || 'Email sent successfully.');
                            }

                            recipients = [];
                            renderRecipients();
                            $recipientInput.val('');
                            $('#subject').val('');
                            $('#content').val('');
                        },
                        error: function (xhr) {
                            showFeedback('danger', 'Unable to send the email.', collectErrorMessages(xhr));
                        },
                        complete: function() {
                            setSending(false);
                        }
                    });
                }
            });
        });

    </script>
@stop
