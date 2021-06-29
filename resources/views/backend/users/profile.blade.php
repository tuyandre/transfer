@extends('backend.includes.master')

@section('title','Home')
@section('css')
    <!-- Internal Gallery css-->
    <link href="{{asset('dashboard/assets/plugins/gallery/gallery.css')}}" rel="stylesheet">
@endsection
@section('content_title','System User Profile')
@section('content_target','My Profile')
@section('contents')


    <!-- Row -->
    <div class="row square">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="panel profile-cover">
                        <div class="profile-cover__img">
                            <img src="{{asset('dashboard/assets/img/users/1.jpg')}}" alt="img" />
                            <h3 class="h3">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h3>
                        </div>

                        <div class="profile-cover__action bg-img"></div>
                        <div class="profile-cover__info">
                            <ul class="nav">
                                <li><strong>26</strong>Devices</li>
                                <li><strong>33</strong>Surveys</li>
                            </ul>
                        </div>
                    </div>
                    <div class="profile-tab tab-menu-heading">
                        <nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
                            <a class="nav-link  active" data-toggle="tab" href="#about">About</a>
                            <a class="nav-link" data-toggle="tab" href="#edit">Edit Profile</a>
                            <a class="nav-link" data-toggle="tab" href="#settings">Change Password</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card main-content-body-profile">
                <div class="tab-content">
                    <div class="main-content-body tab-pane p-4 border-top-0 active" id="about">
                        <div class="card-body p-0 border p-0 rounded-10">

                            <div class="border-top"></div>
                            <div class="p-4">
                                <label class="main-content-label tx-13 mg-b-20">Contact</label>
                                <div class="d-sm-flex">
                                    <div class="mg-sm-r-20 mg-b-10">
                                        <div class="main-profile-contact-list">
                                            <div class="media">
                                                <div class="media-icon bg-primary-transparent text-primary">
                                                    <i class="icon ion-md-phone-portrait"></i> </div>
                                                <div class="media-body"> <span>Full Name</span>
                                                    <div>{{auth()->user()->first_name}} {{auth()->user()->last_name}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mg-sm-r-20 mg-b-10">
                                        <div class="main-profile-contact-list">
                                            <div class="media">
                                                <div class="media-icon bg-success-transparent text-success"> <i class="icon ion-ios-phone-portrait"></i> </div>
                                                <div class="media-body"> <span>Telephone</span>
                                                    <div>{{auth()->user()->telephone}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="main-profile-contact-list">
                                            <div class="media">
                                                <div class="media-icon bg-info-transparent text-info"> <i class="icon ion-md-locate"></i> </div>
                                                <div class="media-body"> <span>Current Address</span>
                                                    <div> {{auth()->user()->city}},{{auth()->user()->state}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top"></div>

                        </div>
                    </div>
                    <div class="main-content-body tab-pane p-4 border-top-0" id="edit">
                        <div class="card-body border">
                            <div class="mb-4 main-content-label">Personal Information</div>
                            <form class="form-horizontal" id="infoForm" method="post" action="{{ route('profiles.updateInfo') }}">
                                @csrf
                                <div id="add-messages"></div>
                                <div class="mb-4 main-content-label">Name</div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">User Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="username" placeholder="User Name" value="{{auth()->user()->username}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">First Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{auth()->user()->first_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">last Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{auth()->user()->last_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 main-content-label">Contact Info</div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Phone</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="telephone" placeholder="phone number" value="{{auth()->user()->telephone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="address"  name="example-textarea-input" rows="2" placeholder="Address">{{auth()->user()->address}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <div class="row row-sm">
                                        <div class="col-md-9">

                                            <div class="mt-3">
                                                <input type="submit" class="btn btn-primary mr-1" id="btnUpdate" value="Update">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="main-content-body tab-pane p-4 border-top-0" id="settings">
                        <div class="card-body border" data-select2-id="12">
                            <form class="form-horizontal" method="post" action="{{ route('profiles.updatePassword') }}" id="passwordForm" data-select2-id="11">
                                @csrf
                                <div class="mb-4 main-content-label">Change password</div>
                                <div id="add-messages"></div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">Old Password</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="password" id="oldp" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password" name="old_password" required>
                                            @error('old_password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3">
                                            <label class="form-label">New Password</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="new Password" name="password" required>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group " >
                                    <div class="row row-sm" >
                                        <div class="col-md-3">
                                            <label class="form-label">Confirm Password</label>
                                        </div>
                                        <div class="col-md-9" data-select2-id="106">
                                            <input type="password" id="confirm" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="confirm password" name="confirm_password" required>
                                            @error('confirm_password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-3"> </div>
                                        <div class="col-md-9">
                                            <div class="mt-3">
                                                <input type="submit" id="btnSave" class="btn btn-primary mr-1" value="Change Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->



@endsection
@section('js')
    <script>
        $(document).ready(function () {

            $('#infoForm').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var btn = $('#btnUpdate');
                btn.button('loading');
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize()
                }).done(function (data) {
                    console.log(data);

                    if (data.info == "ok") {
                        btn.button('reset');
                        form[0].reset();
                        // reload the table

                        $('#add-messages').html('<div class="alert alert-success flat">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Info successfully Updated. </div>');

                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        });
                    }
                }).fail(function (response) {
                    console.log(response.responseJSON);

                    btn.button('reset');
//                    showing errors validation on pages

                    var option = "";
                    option += response.responseJSON.message;
                    var data = response.responseJSON.errors;
                    $.each(data, function (i, value) {
                        console.log(value);
                        $.each(value, function (j, values) {
                            option += '<p>' + values + '</p>';
                        });
                    });
                    $('#add-messages').html('<div class="alert alert-danger flat">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong><i class="glyphicon glyphicon-remove"></i></strong><b>oops:</b>' + option + '</div>');

                    $(".alert-success").delay(500).show(10, function () {
                        $(this).delay(3000).hide(10, function () {
                            $(this).remove();
                        });
                    });

                    //alert("Internal server error");
                });
                return false;
            });

        });
    </script>
    <script>
        $(document).ready(function () {

            $('#passwordForm').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var btn = $('#btnSave');
                btn.button('loading');
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize()
                }).done(function (data) {
                    console.log(data);

                    if (data.password == "ok") {
                        btn.button('reset');
                        form[0].reset();
                        // reload the table

                        $('#add-messages').html('<div class="alert alert-success flat">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Password successfully Changed. </div>');

                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        });
                    }else {
                        btn.button('reset');
                        $('#add-messages').html('<div class="alert alert-warning flat">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Invalid Previous Password. </div>');

                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        });
                    }
                }).fail(function (response) {
                    console.log(response.responseJSON);

                    btn.button('reset');
//                    showing errors validation on pages

                    var option = "";
                    option += response.responseJSON.message;
                    var data = response.responseJSON.errors;
                    $.each(data, function (i, value) {
                        console.log(value);
                        if (i == 'name') {
                            $('#tname').html(value[0])
                        }
                        $.each(value, function (j, values) {
                            option += '<p>' + values + '</p>';
                        });
                    });
                    $('#add-messages').html('<div class="alert alert-danger flat">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong><i class="glyphicon glyphicon-remove"></i></strong><b>oops:</b>' + option + '</div>');

                    $(".alert-success").delay(500).show(10, function () {
                        $(this).delay(3000).hide(10, function () {
                            $(this).remove();
                        });
                    });

                    //alert("Internal server error");
                });
                return false;
            });

        });
    </script>
    <!-- Internal Gallery js-->
    <script src="{{asset('dashboard/assets/plugins/gallery/picturefill.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/gallery/lightgallery.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/gallery/lightgallery-1.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/gallery/lg-pager.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/gallery/lg-autoplay.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/gallery/lg-fullscreen.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/gallery/lg-zoom.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/gallery/lg-hash.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/gallery/lg-share.js')}}"></script>
@endsection

