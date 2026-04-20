<!-- Client Info Modal -->
<style>
    #clientInfoModal .client-info-feedback {
        margin-bottom: 16px;
    }

    #clientInfoModal .client-info-feedback ul {
        margin: 8px 0 0 18px;
        padding: 0;
    }

    #clientInfoModal .client-info-status {
        align-items: center;
        color: #4a5568;
        display: none;
        gap: 10px;
        margin-right: 16px;
    }

    #clientInfoModal .client-info-status.is-visible {
        display: inline-flex;
    }

    #clientInfoModal .client-info-spinner {
        animation: spin 1s linear infinite;
        border: 3px solid #d9e2f2;
        border-radius: 50%;
        border-top: 3px solid #3498db;
        display: inline-block;
        height: 20px;
        width: 20px;
    }

    #clientInfoModal .save-btn[disabled],
    #clientInfoModal .clear-btn[disabled] {
        cursor: not-allowed;
        opacity: 0.7;
    }
</style>
<div class="modal fade" id="clientInfoModal" tabindex="-1" role="dialog" aria-labelledby="clientInfoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #000;">Client Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <input type="hidden" id="client_id" name="client_id">
                <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" id="mode" name="mode">
                <div class="modal-body">
                    <div class="alert alert-danger client-info-feedback" style="display: none;">
                        <strong>We couldn't complete the request.</strong>
                        <ul class="client-info-error-list"></ul>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="col">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="col-4">
                            <label>Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Phone</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Digits Only No Spaces or Special Characters" required>
                        </div>
                        <div class="col">
                            <label>Emergency Contact Person</label>
                            <input type="text" class="form-control" id="emergency_contact_person" name="emergency_contact_person" placeholder="Contact person name" required>
                        </div>
                        <div class="col">
                            <label>Emergency Contact Person Phone Number</label>
                            <input type="text" class="form-control" id="emergency_contact_number" name="emergency_contact_number" placeholder="Digits Only No Spaces or Special Characters"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" autocomplete="bday" max="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="col">
                            <label>Session and Cost</label>
                            <select class="form-control" id="session_cost_type" name="session_cost_type" required>
                                <option value="senior">Senior Rate</option>
                                <option value="children">Children Rate</option>
                                <option value="group">Group Rate</option>
                                <option value="normal">Normal Rate</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>&nbsp;</label>
                            <input type="number" min="0" class="form-control" id="session_cost" name="session_cost" placeholder="Please input price" required>
                        </div>
                        <div class="col">
                            <label>&nbsp;</label>
                            <input type="checkbox" class="form-check-input" id="session_paid" name="session_paid">
                            <label class="form-check-label">Paid?</bel>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="client-info-status" aria-live="polite">
                        <span class="client-info-spinner"></span>
                        <span class="client-info-status-text">Saving client information...</span>
                    </div>
                    <button type="button" class="btn btn-danger mr-auto clear-btn">Clear</button>
                    <button type="button" class="btn save-btn">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Client Info Modal -->
