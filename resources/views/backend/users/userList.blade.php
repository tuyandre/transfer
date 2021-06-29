@extends('backend.includes.master')

@section('title','User')
@section('css')
    <!-- Internal DataTables css-->
    <link href="{{asset('dashboard/assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('content_title','System User List')
@section('content_target','User List')
@section('action_buttons')
    <button type="button" class="btn btn-primary my-2 btn-icon-text" id="add_user">
        <i class="fe fe-user-plus mr-2"></i> Add New User
    </button>
    @endsection
    @section('contents')


        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-1">User List</h6>

                        </div>
                        <div class="table-responsive table-hover">
                            <table class="table" id="userListTable">
                                <thead>
                                <tr>
                                    <th class="wd-20p">First Name</th>
                                    <th class="wd-20p">Last Name</th>
                                    <th class="wd-25p">Email</th>
                                    <th class="wd-20p">Telophone</th>
                                    <th class="wd-20p">Position</th>
                                    <th class="wd-15p">Status</th>
                                    <th class="wd-20p">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
        <!-- Basic modal -->
        <div class="modal" id="addUser">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Add users</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="add-messages"></div>
                        <form action="{{route('users.saveMember')}}" method="post" data-parsley-validate="" id="frmSave">
                            {{ csrf_field() }}
                            <div class="">
                                <div class="row row-sm form-group">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Position:
                                                </div>
                                            </div>
                                            <?php

                                            $roles=\App\Models\Role::all();
                                            ?>

                                            <select name="role" class="form-control select2">
                                                <option value="">Select Position</option>
{{--                                                @foreach($roles as $role)--}}
{{--                                                <option value="{{$role->id}}">{{$role->display_name}}</option>--}}
{{--                                                @endforeach--}}
                                                <option value="admin">Administrator</option>
                                                <option value="member">Member</option>
                                                <option value="senior">Senior Employer</option>
                                            </select>
{{--                                            <input class="form-control" id="textMask" name="first_name" placeholder="First name" type="text" required>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm form-group">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    First Name:
                                                </div>
                                            </div><input class="form-control" id="textMask" name="first_name" placeholder="First name" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm form-group">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Last Name:
                                                </div>
                                            </div><input class="form-control" name="last_name" required id="mask" placeholder="Last Name" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm form-group">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Email:
                                                </div>
                                            </div><input class="form-control" name="email" required id="emailMask" placeholder="Email" type="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm form-group">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Phone:
                                                </div>
                                            </div><input class="form-control" required name="phone" id="phoneMask" placeholder="phone" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm form-group">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Password:
                                                </div>
                                            </div>
                                            <input class="form-control" id="passwordMask" placeholder="Password" type="password" required name="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm form-group">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Confirm Password:
                                                </div>
                                            </div><input class="form-control" id="confirm" placeholder="confirm Password" type="password" name="confirm" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnSave">Save changes</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal"  type="button">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- End Basic modal -->

        <input type="hidden" value="{{ Session::token() }}" id="token">
    @endsection
    @section('js')
        <script>

            var defaultUrl = "{{ route('members.getMembers') }}";
            var table;
            var manageTable = $("#userListTable");
            function myFunc() {
                table = manageTable.DataTable({
                    ajax: {
                        url: defaultUrl,
                        dataSrc: 'members'
                    },
                    columns: [

                        {data: 'first_name'},
                        {data: 'last_name'},
                        {data: 'email'},
                        {data: 'telephone'},
                        {data: 'role.display_name'},
                        {data: 'confirmed',
                            render: function (data, type, row) {
                                if(row.confirmed==1){
                                    return "<span class='bg-success'> Activated</span>";
                                }else {
                                    return "<span class='bg-warning'>Not  Activated</span>";
                                }

                            }},
                        {
                            data: 'id',
                            render: function (data, type, row) {
                                if(row.confirmed==1){
                                    return"<a  href='/Administration/member/detail/" + row.id + "' class='btn btn-info btn-sm btn-flat js-detail' data-id='" + data +
                                        "' > <i class='fa fa-eye'></i>View</a>" +
                                        "<button class='btn btn-danger btn-sm btn-flat js-delete ' data-id='" + data +
                                        "' data-url='/Administration/member/delete/" + row.id + "'> <i class='fa fa-trash'></i>Delete</button>";
                                }else {
                                    return "<button class='btn btn-success btn-sm btn-flat js-confirm' data-id='" + data +
                                        "' data-url='/Administration/member/confirm/" + row.id + "'> <i class='fa fa-check'></i>Confirm</button>" +
                                        "<a  href='/Administration/member/detail/" + row.id + "' class='btn btn-info btn-sm btn-flat js-detail' data-id='" + data +
                                        "' > <i class='fa fa-eye'></i>View</a>" +
                                        "<button class='btn btn-danger btn-sm btn-flat js-delete ' data-id='" + data +
                                        "' data-url='/Administration/member/delete/" + row.id + "'> <i class='fa fa-trash'></i>Delete</button>";
                                }

                            }
                        }
                    ]
                });
            }


            $(document).ready(function () {
                $("#add_user").click(function(){
                    $("#addUser").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                });
    //initialize data table
                myFunc();


                $('#frmSave').submit(function (e) {
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

                        if (data.message == "ok") {
                            btn.button('reset');
                            form[0].reset();
                            // reload the table
                            table.destroy();
                            myFunc();
                            $('#add-messages').html('<div class="alert alert-success flat">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> User  successfully Registered. </div>');

                            $(".alert-success").delay(500).show(10, function () {
                                $(this).delay(3000).hide(10, function () {
                                    $(this).remove();
                                });
                            });
                            location.reload();
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

                manageTable.on('click', '.js-confirm', function () {
                    var button = $(this);
                    bootbox.confirm("Are you sure you want to Confirm this member?", function (result) {
                        if (result) {
                            $.ajax({
                                url: button.attr('data-url'),
                                method: 'PUT',
                                data: {_token: $('#token').val()},
                                success: function (data) {
                                    console.log(data);
                                    if(data.result=="ok"){
                                        var tr = button.parents("tr");
                                        bootbox.alert({
                                            title: "success",
                                            message: "<i class='fa fa-success'></i>" +
                                                " User Confirmed successful"
                                        });
                                    }else{
                                        var tr = button.parents("tr");
                                        bootbox.alert({
                                            title: "warning",
                                            message: "<i class='fa fa-warning'></i>" +
                                                " User Not Confirmed successful Because message not sent"
                                        });
                                    }

                                    table.rows(tr).remove().draw(false);
                                    table.destroy();
                                    myFunc();
                                }, error: function () {
                                    bootbox.alert({
                                        title: "Error",
                                        message: "<i class='fa fa-warning'></i>" +
                                            " user not Confirmed please try again"
                                    });
                                }
                            });

                        }
                    })
                });


                manageTable.on('click', '.js-delete', function () {
                    var button = $(this);
                    bootbox.confirm("Are you sure you want to Delete this member?", function (result) {
                        if (result) {
                            $.ajax({
                                url: button.attr('data-url'),
                                method: 'delete',
                                data: {_token: $('#token').val()},
                                success: function (data) {
                                    console.log(data);
    //                            var tr = button.parents("tr");
                                    bootbox.alert({
                                        title: "success",
                                        message: "<i class='fa fa-warning'></i>" +
                                            " User Delete successful"
                                    });
                                    table.rows(tr).remove().draw(false);
                                    table.destroy();
                                    myFunc();
                                }, error: function () {
                                    bootbox.alert({
                                        title: "Error",
                                        message: "<i class='fa fa-warning'></i>" +
                                            " user not Delete please try again"
                                    });
                                }
                            });

                        }
                    })
                });


            });
        </script>


        <!-- Internal Data Table js -->
        <script src="{{asset('dashboard/assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/fileexport/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/fileexport/jszip.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/fileexport/pdfmake.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/fileexport/vfs_fonts.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/fileexport/buttons.html5.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/fileexport/buttons.print.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/plugins/datatable/fileexport/buttons.colVis.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/js/table-data.js')}}"></script>
    @endsection

