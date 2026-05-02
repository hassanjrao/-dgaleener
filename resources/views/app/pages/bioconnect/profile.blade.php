@extends('layouts.application')
@section('page-title')
    {{'Anew Avenue Biomagnestim | Bio Connect Profile'}}
@stop
@section('styles')
    @parent
    <link href="{{ \App\Support\VersionedAsset::url('css/app/bioconnect.css') }}" rel="stylesheet">
    <link href="{{ \App\Support\VersionedAsset::url('css/app/bioconnect/profile.css') }}" rel="stylesheet">
@stop
@section('content')
    @include('partials.header', ['title' => 'Bio Connect', 'image_url' => '/images/iconimages/share24.png', 'menu' => 'bioconnect'])
    <div class="row main-body">
        <div class="col-md-12 text-center">
            <a href=""><img src="{{ $pro_info->profilePictureUrl() }}" class="profile-image" alt="{{ env('APP_TITLE') }}"> </a>
        </div>
    </div>
    <div class="row" id="personal-info">
        <div class="col-md-12">
            <form id="form-post" method="post" action="{{ URL::route('saveprofile') }}" enctype="multipart/form-data" >
			@csrf						
			<input hidden id="user_id" name="user_id" type="text" value="{{ Auth::user()->id }}"  />
			    <div class="form-group row">
                    <label for="upload" class="col-sm-2 offset-md-1 col-form-label">Profile Picture:</label>
                    <div class="col-sm-8">
                        <input id="upload" name="upload" type="file" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="togBtn" class="col-sm-2 offset-md-1 col-form-label">Privacy:</label>
                    <div class="col-sm-8">
                        <label class="switch">
							<input type="checkbox" id="togBtn" name="togBtn" {{ Auth::user()->privacy ? 'checked' : ''}}>
                            <div class="slider round"></div>
                            @error('privacy')
                                <strong class="invalid">{{ $errors->first('privacy') }}</strong>
                            @enderror
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 offset-md-1 col-form-label">Name:</label>		
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="your name here" value="{{ Auth::user()->name}}" required>
                        @error('name')
                            <strong class="invalid">{{ $errors->first('name') }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 offset-md-1 col-form-label">Email ID:</label>		
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" placeholder="your email here" value="{{ Auth::user()->email}}" required>
                        @error('email')
                            <strong class="invalid">{{ $errors->first('email') }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="business" class="col-sm-2 offset-md-1 col-form-label">Business:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="business" name="business" placeholder="your business name here" value="{{ Auth::user()->business}}">
                        @error('business')
                            <strong class="invalid">{{ $errors->first('business') }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age" class="col-sm-2 offset-md-1 col-form-label">Age:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="age" name="age" placeholder="age" value="{{ Auth::user()->age}}" min="0">
                        @error('age')
                            <strong class="invalid">{{ $errors->first('age') }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="location" class="col-sm-2 offset-md-1 col-form-label">Location:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="location" value="{{ Auth::user()->location}}"  name="location" placeholder="your location here">
                        @error('location')
                            <strong class="invalid">{{ $errors->first('location') }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 offset-md-1 col-form-label">Address:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" name="address" placeholder="your address here" value="{{ Auth::user()->address }}">
                        @error('address')
                            <strong class="invalid">{{ $errors->first('address') }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="country" class="col-sm-2 offset-md-1 col-form-label">Country:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="country" name="country" placeholder="country" value="{{ Auth::user()->country}}">
                        @error('country')
                            <strong class="invalid">{{ $errors->first('country') }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="zip" class="col-sm-2 offset-md-1 col-form-label">Zip:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="zip" name="zip" placeholder="zip" value="{{ Auth::user()->zip}}">
                        @error('zip')
                            <strong class="invalid">{{ $errors->first('zip') }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-7 offset-xs-5 offset-sm-5 col-3">
                        <button type="submit" id="submit" class="form-control text-center create-button">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6"></div>
    </div>
@endsection
@section('javascripts')
    @parent
    @include('partials.bioconnect.firebase_config')

    <script type="text/javascript">
        $( document ).ready(function() {

            $('#form-post').on('submit',function(event){

                if($("#togBtn").is(":checked")){
                    var privacy = 1;
                }else{ privacy = 0;}

                var uage = $('#age').val();
                var ucountry = $('#country').val();
                var ulocation = $('#location').val();
                var uaddress = $('#address').val();
                var uzip = $('#zip').val();
                var ulogo = $('#upload').val() || '';
                var logo_name = '';
                var uname = $('#name').val();
                if (ulogo !== '') {
                    var fileExtension = ulogo.replace(/^.*\./, '');
                    logo_name = 'user-{{Auth::user()->id}}.'+fileExtension;
                }
                var fbinitupdataeuser = firebase.database().ref().child('post').orderByChild("post_byId").equalTo("{{Auth::user()->id}}");

                var fbinitcommentsupdate = firebase.database().ref().child('post');
                var fbinituserfriendupdate = firebase.database().ref().child('friends');

                //update in friends
                fbinituserfriendupdate.on("value", function (snap3) {
                        //alert(snap3.key);
                    snap3.forEach(function (childsnap3) {
                        var userParentId = childsnap3.key;
                        var userChildValue = childsnap3.val();
                        if( userParentId != "{{Auth::user()->id}}" ){
                            var userarray = Object.keys(userChildValue);
                            userarray.forEach(function(element) {
                                if(element === "{{Auth::user()->id}}"){

                                    firebase.database().ref().child('friends/'+ userParentId + '/' + element ).update({
                                        name: uname,
                                        age: uage,
                                        address: uaddress,
                                        country: ucountry,
                                        location: ulocation,
                                        zip: uzip,
                                        privacy: privacy
                                    });

                                    if( ulogo != ''){
                                        firebase.database().ref().child('friends/'+ userParentId + '/' + element ).update({
                                            logo: logo_name
                                        });
                                    }

                                }
                            });
                        }
                    });
                });

                //update in post
                fbinitupdataeuser.on("value", function (snap) {
                        //alert(snap.key);
                    snap.forEach(function (childsnap) {
                        //alert(childsnap.key);
                        firebase.database().ref().child('post/'+ childsnap.key ).update({
                            post_byName: uname
                        });
                        if( ulogo != ''){
                            firebase.database().ref().child('post/'+ childsnap.key ).update({
                                user_Logo: logo_name
                            });
                        }
                    });
                });

                //update in comment
                fbinitcommentsupdate.on("value", function (snap) {
                        //alert(snap.key);
                    snap.forEach(function (childsnap) {
                        var parentkey = childsnap.key;
                        var fbinitcommentkey = firebase.database().ref().child('post/'+ parentkey +'/comments');

                        fbinitcommentkey.on("value", function (snap2) {
                            var getchild = snap2.val();
                            //alert(JSON.stringify(dor));
                            if(getchild != ''){
                                snap2.forEach(function (childsnap2) {
                                    var gettargetinfo = childsnap2.val();
                                    if( gettargetinfo.comment_byId === "{{Auth::user()->id}}" ){

                                        firebase.database().ref().child('post/'+ parentkey + '/comments/' + childsnap2.key ).update({
                                            comment_byName: uname
                                        });

                                        if( ulogo != ''){
                                            firebase.database().ref().child('post/'+ parentkey + '/comments/' + childsnap2.key ).update({
                                                user_Logo: logo_name
                                            });
                                        }
                                    }
                                });
                            }
                        });
                        /* firebase.database().ref().child('post/'+ childsnap.key ).update({
                            post_byName: uname
                        });
                        if( ulogo != ''){
                            firebase.database().ref().child('post/'+ childsnap.key ).update({
                                user_Logo: logo_name
                            });
                        } */
                    });
                });

                alert("success");
                /*


                var uname = $('#name').val(); */


            });

        });

    </script>
		
	<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSgmtix970nRBeQmqCVWOqhh-TT6moojU&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script>
      var placeSearch, autocomplete;
      var componentForm = {
        country: 'long_name',
        zip: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('location')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script-->
@stop
