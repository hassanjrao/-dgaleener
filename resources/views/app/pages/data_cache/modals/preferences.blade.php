<!-- Preferences Modal -->
<div class="modal fade" id="preferencesModal" tabindex="-1" role="dialog" aria-labelledby="preferencesModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #000;">Preferences</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">  
                    <div id="tabs">
                        <ul>
                            <li><a href="#tabs-user">User</a></li>
                            <li><a href="#tabs-logos">Logos</a></li>
                        </ul>
                        <div id="tabs-user">
                            <div class="alert alert-success alert-preferences-success" style="display: none;">
                                <h5><i class="icon fa fa-info"></i> Save Success! You have successfully update your preferences.</h5>
                            </div>
                            <div class="alert alert-danger alert-preferences-error" style="display: none;">
                                <h5><i class="icon fa fa-info"></i> Save Failed! An error occurred.</h5>
                            </div>
                            <form id="form-preferences" method="PUT" action="/data_cache/preferences/update">
                                @csrf
                                <input id="pref_user_id" type="hidden" value="{{ Auth::user()->id}}" />
                                <input id="pref_user_email" type="hidden" value="{{ Auth::user()->email}}" />
                                <input id="pref_user_name" type="hidden" value="{{ Auth::user()->name}}" />
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" id="pref_company_name" name="pref_company_name" value="{{ Auth::user()->company_name}}" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col" style="padding-left: 0;">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" id="pref_first_name" name="pref_first_name" value="{{ Auth::user()->first_name}}" required>
                                    </div>
                                    <div class="col" style="padding-right: 0;">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" id="pref_last_name" name="pref_last_name" value="{{ Auth::user()->last_name}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col" style="padding-left: 0;">
                                        <label>Phone #</label>
                                        <input type="text" class="form-control" id="pref_phone_no" name="pref_phone_no" value="{{ Auth::user()->phone_no}}" required>
                                    </div>
                                    <div class="col" style="padding-right: 0;">
                                        <label>Fax #</label>
                                        <input type="text" class="form-control" id="pref_fax_no" name="pref_fax_no" value="{{ Auth::user()->fax_no}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="pref_alternate_email" name="pref_alternate_email" value="{{ Auth::user()->alternate_email ? Auth::user()->alternate_email : Auth::user()->email}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="billing_title">Billing Title</label>
                                    <input type="text" class="form-control" id="pref_billing_title" name="pref_billing_title" value="{{ Auth::user()->billing_title}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="pref_address" name="pref_address" value="{{ Auth::user()->address}}" required>
                                </div>
                                <button type="submit" id="submit_pref" class="form-control btn save-btn">Save</button>
                            </form>
                        </div>
                        <div id="tabs-logos">
                            <form method="POST" enctype="multipart/form-data" id="logoForm" action="{{ url('/data_cache/upload_logo') }}">
                                @csrf
                                <div id="form-part" style="display: inline-flex;">
                                    <input type="file" id="logo_file" name="logo_file" accept=".jpg,.jpeg,.png" required="">
                                    <button type="submit" id="logoSubmit" class="form-control btn btn-primary">Upload</button>
                                </div>
                                <div id="loader-part" style="display: none;">
                                    <br/><br/><div class="loader" style="margin:0 auto;"></div><br/>
                                    <p style="text-align:center">{{ __('Please wait... file upload is still being processed...') }}</p><br/>
                                </div>
                                <div>
                                <div class="row" style="margin-top: 10px;">
                                    @foreach(\App\Models\Logo::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get() as $logo)
                                        <div style="display: grid; margin: 5px;">
                                            <img src="{{$logo->file_url()}}" class="logo-box {{ Auth::user()->logo == $logo->s3_name ? 'active' : '' }}" alt="{{ env('APP_TITLE') }}" data-logo="{{ $logo->s3_name }}" data-user-id="{{ Auth::user()->id }}" />
                                            @if (Auth::user()->logo != $logo->s3_name)
                                                <button class="btn-danger logo-delete" style="cursor: pointer; width: 100%;" data-logo-id="{{$logo->id}}">Delete</button>
                                            @endif
                                        </div>
                                        
                                    @endforeach
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Preferences Modal -->
