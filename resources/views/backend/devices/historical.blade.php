@extends('backend.includes.master')

@section('title','Devices')
@section('css')
    <!-- Internal DataTables css-->
    <link href="{{asset('dashboard/assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('content_title','System Devices List')
@section('content_target','Historical Devices')
{{--@section('action_buttons')--}}
{{--    <button type="button" class="btn btn-primary my-2 btn-icon-text" id="add_device">--}}
{{--        <i class="fe fe-user-plus mr-2"></i> Add New Device--}}
{{--    </button>--}}
{{--@endsection--}}
@section('contents')

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Historical Devices List</h6>

                    </div>
                    <div class="table-responsive table-hover">
                        <table class="table" id="DeviceListTable">
                            <thead>
                            <tr>
                                <th class="wd-20p">Device Name</th>
{{--                                <th class="wd-20p">Device Brand</th>--}}
                                <th class="wd-20p">Device Model</th>
                                <th class="wd-20p">Device S/N</th>
                                <th class="wd-25p">Member</th>
                                <th class="wd-25p">Received Date</th>
                                <th class="wd-25p">Returned Date</th>
{{--                                <th class="wd-20p">Action</th>--}}
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


    <input type="hidden" value="{{ Session::token() }}" id="token">
@endsection
@section('js')
    <script>
        var defaultUrl = "{{ route('admin.devices.getHistorical') }}";
        var table;
        var manageTable = $("#DeviceListTable");
        function myFunc() {
            table = manageTable.DataTable({
                ajax: {
                    url: defaultUrl,
                    dataSrc: 'devices'
                },
                columns: [
                    {data: 'device.device_name'},
                    {data: 'device.device_model'},
                    {data: 'device.device_serialNo'},
                    {data: 'member_id',
                        render: function (data, type, row) {

                            if (data !=null){
                                return "<span>"+row.member.first_name+" "+row.member.last_name+"</span>";
                            }else{
                                return "";
                            }
                        }
                    },
                    {data: 'received_date'},
                    {data: 'returned_date'}
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

