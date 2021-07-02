@extends('backend.includes.master')

@section('title','User')
@section('css')
    <!-- Internal DataTables css-->
    <link href="{{asset('dashboard/assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('content_title','Clients Transaction')
@section('content_target','Clients Withdraw Transaction')

@section('contents')


    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Client Withdraw Pending</h6>

                    </div>
                    <div class="table-responsive table-hover">
                        <table class="table" id="userListTable">
                            <thead>
                            <tr>
                                <th class="wd-20p">Date</th>
                                <th class="wd-20p">Client Name</th>
                                <th class="wd-25p">Agent Name</th>
                                <th class="wd-20p">Amount</th>
                                <th class="wd-15p">Charges</th>
                                <th class="wd-15p">Action</th>
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

    <input type="hidden" value="{{ Session::token() }}" id="token">
@endsection
@section('js')
    <script>

        var defaultUrl = "{{ route('agent.clients.getClientPendingWithdraw') }}";
        var table;
        var manageTable = $("#userListTable");
        function myFunc() {
            table = manageTable.DataTable({
                ajax: {
                    url: defaultUrl,
                    dataSrc: 'transactions'
                },
                "ordering": false,
                columns: [

                    {data: 'created_at'},
                    {data: 'transfer.name'},
                    {data: 'receiver.name'},
                    {data: 'amounts'},
                    {data: 'fees'},
                    {
                        data: 'id',
                        render: function (data, type, row) {
                            var url_release='{{route("agent.clients.approvePendingWithdraw",":id")}}';
                            url_release=url_release.replace(':id',row.id);

                                return "<button class='btn btn-primary btn-sm btn-flat js-approve ' data-id='" + row.id +
                                    "' data-url='" + url_release + "'> <i class='fa fa-send'></i>Approve</button>";


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
            manageTable.on('click', '.js-approve', function () {
                var button = $(this);
                bootbox.confirm("Are you sure you want to Appove this Withdraw?", function (result) {
                    if (result) {
                        $.ajax({
                            url: button.attr('data-url'),
                            method: 'get',
                            data: {_token: $('#token').val()},
                            success: function (data) {
                                console.log(data);
                                var tr = button.parents("tr");
                                bootbox.alert({
                                    title: "success",
                                    message: "<i class='fa fa-success'></i>" +
                                        " Withdraw successful"
                                });
                                table.rows(tr).remove().draw(false);
                                table.destroy();
                                myFunc();
                            }, error: function () {
                                bootbox.alert({
                                    title: "Error",
                                    message: "<i class='fa fa-warning'></i>" +
                                        " With not Completed"
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

