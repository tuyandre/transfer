@extends('backend.includes.master')

@section('title','Devices')
@section('css')
    <!-- Internal DataTables css-->
    <link href="{{asset('dashboard/assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('content_title','System Devices List')
@section('content_target','All Devices')
@section('action_buttons')
    <button type="button" class="btn btn-primary my-2 btn-icon-text" id="add_device">
        <i class="fe fe-user-plus mr-2"></i> Add New Device
    </button>
@endsection
@section('contents')

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Devices List</h6>

                    </div>
                    <div class="table-responsive table-hover">
                        <table class="table" id="DeviceListTable">
                            <thead>
                            <tr>
                                <th class="wd-20p">Device Name</th>
                                <th class="wd-20p">Device Model</th>
                                <th class="wd-20p">Device S/N</th>
                                <th class="wd-25p">Status</th>
                                <th class="wd-20p">Member</th>
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

    <!-- Basic modal -->
    <div class="modal" id="addDevice">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add Device</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="add-messages"></div>
                    <form action="{{route('admin.devices.saveDevices')}}" method="post" data-parsley-validate="" id="frmSave">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="row row-sm form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Device Name:
                                            </div>
                                        </div>

                                        <input class="form-control" id="textMask" name="device_name" placeholder="Device name" type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Device Brand:
                                            </div>
                                        </div><input class="form-control" id="textMask" name="device_brand" placeholder="Device Brand" type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Device Model:
                                            </div>
                                        </div><input class="form-control" name="device_model" required id="mask" placeholder="Device Model" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Devicen S/N:
                                            </div>
                                        </div><input class="form-control" name="device_serialNo" required id="emailMask" placeholder="Device Serial Number" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Device IMEI 1:
                                            </div>
                                        </div>
                                        <input class="form-control" id="passwordMask" placeholder="IMEI ONE" type="number" required name="imei1">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                               Device IMEI 2:
                                            </div>
                                        </div><input class="form-control" id="imei2" placeholder="IMEI TWO " type="number" name="imei2">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="btnSave">Save Device</button>
                            <button class="btn ripple btn-secondary" data-dismiss="modal"  type="button">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->
    <!-- Assign Device modal -->
    <div class="modal" id="assignDevice">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Assign Device</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="add-messages1"></div>
                    <form action="{{route('admin.devices.assignDevices')}}" method="post" data-parsley-validate="" id="assignFrmSave">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="row row-sm form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Select Member:
                                            </div>
                                        </div>
                                        <?php

                                        $roles=\App\Models\User::with(['Role'])
                                            ->whereHas(
                                                'roles', function($q){
                                                $q->where('name', 'member');
                                            }
                                            )->get();
                                        ?>

                                        <select name="member" class="form-control select2">
                                            <option value="">Select Member</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->first_name}} {{$role->last_name}}</option>
                                            @endforeach
                                        </select>
                                        <input class="form-control" id="device_name" name="device_name" type="hidden" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="btnSave2">Assign Device</button>
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
    var defaultUrl = "{{ route('admin.devices.getDevices') }}";
    var table;
    var manageTable = $("#DeviceListTable");
    function myFunc() {
        table = manageTable.DataTable({
            ajax: {
                url: defaultUrl,
                dataSrc: 'devices'
            },
            columns: [
                {data: 'device_name'},
                {data: 'device_model'},
                {data: 'device_serialNo'},
                {data: 'status',
                    render: function (data, type, row) {
                        if(row.status==1){
                            return "<span class='bg-success'> Available</span>";
                        }else {
                            return "<span class='bg-warning'>Not  Available</span>";
                        }

                    }},
                {data: 'member_id',
                    render: function (data, type, row) {

                    if (data !=null){
                        return "<span>"+row.member.first_name+"</span>";
                    }else{
                        return "";
                    }
                    }

                },
                {
                    data: 'status',
                    render: function (data, type, row) {
                        var url_more = '{{ route("admin.devices.deviceDetail", ":id") }}';
                        url_more = url_more.replace(':id', row.id);
                        var url_show='{{route("admin.devices.showDevice",":id")}}';
                        url_show=url_show.replace(':id',row.id);
                        var url_release='{{route("admin.devices.releaseDevice",":id")}}';
                        url_release=url_release.replace(':id',row.id);
                        if(data==1){

                            return"<a  href='"+url_more+"' class='btn btn-info btn-sm btn-flat js-detail' data-id='" + data +
                                "' > <i class='fa fa-eye'></i>View</a>" +
                                "<button class='btn btn-primary btn-sm btn-flat js-assign ' data-id='" + row.id +
                                "' data-url='" + url_show + "'> <i class='fa fa-send'></i>Assign</button>" +
                                "<button class='btn btn-secondary btn-sm btn-flat js-edit ' data-id='" + row.id +
                                "' data-url='" + url_show + "'> <i class='fa fa-pen'></i>Edit</button>";
                        }else {
                            return "<a  href='"+url_more+"' class='btn btn-info btn-sm btn-flat js-detail' data-id='" + row.id +
                                "' > <i class='fa fa-eye'></i>View</a>" +
                                "<button class='btn btn-success btn-sm btn-flat js-confirm' data-id='" + data +
                                "' data-url='" + url_release + "'> <i class='fa fa-check'></i>Release</button>";
                        }

                    }
                }
            ]
        });
    }


    $(document).ready(function () {
        $("#add_device").click(function () {
            $("#addDevice").modal({
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

                if (data.device == "ok") {
                    btn.button('reset');
                    form[0].reset();
                    // reload the table
                    table.destroy();
                    myFunc();
                    $('#add-messages').html('<div class="alert alert-success flat">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Device  successfully Registered. </div>');

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

        //forward file to the client
        manageTable.on('click', '.js-assign', function () {
            $("#assignDevice").modal({
                backdrop: 'static',
                keyboard: false
            });
            var file = $(this).attr('data-id');
            $("#device_name").val(file);
            $('#assignFrmSave').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var btn = $('#btnSave2');
                btn.attr("disabled", true);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: new FormData(this),
                    dataType: "JSON",
                    contentType: false,
                    cashe: false,
                    processData: false,
                }).done(function (data) {
                    console.log(data);

                    if (data.device == "ok") {
                        form[0].reset();
                        // reload the table
                        table.destroy();
                        myFunc();
                        $('#add-messages1').html('<div class="alert alert-success flat">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Device  successfully Assigned. </div>');

                        $(".alert-success").delay(1000).show(10, function () {
                            $(this).delay(1000).hide(10, function () {
                                $(this).remove();
                            });
                        });
                        btn.attr("disabled", false);
                        location.reload();

                    }
                }).fail(function (response) {
                    console.log(response.responseJSON);

                    btn.attr("disabled", false);
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
                    $('#add-messages1').html('<div class="alert alert-danger flat">' +
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


        manageTable.on('click', '.js-confirm', function () {
            var button = $(this);
            bootbox.confirm("Are you sure you want to Return  this Device?", function (result) {
                if (result) {
                    $.ajax({
                        url: button.attr('data-url'),
                        method: 'post',
                        data: {_token: $('#token').val()},
                        success: function (data) {
                            console.log(data);
                            var tr = button.parents("tr");
                            bootbox.alert({
                                title: "success",
                                message: "<i class='fa fa-warning'></i>" +
                                    " Device Released successful"
                            });
                            table.rows(tr).remove().draw(false);
                            table.destroy();
                            myFunc();
                        }, error: function () {
                            bootbox.alert({
                                title: "Error",
                                message: "<i class='fa fa-warning'></i>" +
                                    " Device Not Released please try again"
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

