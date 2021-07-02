@extends('backend.includes.master')

@section('title','User')
@section('css')
    <!-- Internal DataTables css-->
    <link href="{{asset('dashboard/assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('content_title','Transaction List')
@section('content_target','Customer Transaction  Detail')

@section('contents')


    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1"> <span style="color:#34ce57;">{{$user->name}} </span>  Transaction Detail</h6>

                    </div>
                    <div class="table-responsive table-hover">
                        <table class="table" id="userListTable">
                            <thead>
                            <tr>
                                <th class="wd-20p">Date</th>
                                <th class="wd-20p">Sender/Agent Name</th>
                                <th class="wd-25p">Receiver Name</th>
                                <th class="wd-20p">Previous Balannces</th>
                                <th class="wd-20p">Amount</th>
                                <th class="wd-20p">Balance</th>
                                <th class="wd-20p">Category</th>
                                <th class="wd-15p">Charges</th>
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

        {{--var defaultUrl = "{{ route('admin.users.getCustomerDetail',['id'=>$user->id]) }}"--}}
        var defaultUrl = "{{ route("admin.users.getCustomerDetail", ":id") }}";
        var user="{{$user->id}}";
        console.log("customer id:"+user);
        defaultUrl = defaultUrl.replace(':id', user);
        console.log("customer url id:"+defaultUrl);
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
                    {data: 'previous_balances'},
                    {data: 'amounts'},
                    {data: 'balances'},
                    {data: 'category'},
                    {data: 'fees'}
                ]
            });
        }


        $(document).ready(function () {
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

