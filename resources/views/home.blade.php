@extends('backend.includes.master')

@section('title','Home')
@section('css')

@endsection
@section('content_title','DASHBOARD')
@section('content_target','DASHBOARD SUMMARY')
@section('contents')

    @if(Auth::user()->hasRole("admin"))
        <div class="row row-sm">
            <div class="col-sm-12 col-lg-12 col-xl-8">

                <!--Row-->
                <div class="row row-sm  mt-lg-4">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="card bg-primary custom-card card-box">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="offset-xl-3 offset-sm-6 col-xl-8 col-sm-6 col-12 img-bg ">
                                        <h4 class="d-flex  mb-3">
                                            <span class="font-weight-bold text-white ">{{auth()->user()->name}}!</span>
                                        </h4>
                                        <p class="tx-white-7 mb-1">Welcome on Quick Money Transfer </p>
                                    </div>
                                    <img src="{{asset('dashboard/assets/img/pngs/work3.png')}}" alt="user-img" class="wd-200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Row -->

                <!--Row-->
                <div class="row row-sm">
{{--                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">--}}
{{--                        <div class="card custom-card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="card-item">--}}
{{--                                    <div class="card-item-icon card-icon">--}}
{{--                                        <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect height="14" opacity=".3" width="14" x="5" y="5"/><g><rect fill="none" height="24" width="24"/><g><path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M19,19H5V5h14V19z"/><rect height="5" width="2" x="7" y="12"/><rect height="10" width="2" x="15" y="7"/><rect height="3" width="2" x="11" y="14"/><rect height="2" width="2" x="11" y="10"/></g></g></g></svg>--}}
{{--                                    </div>--}}
{{--                                    <div class="card-item-title mb-2">--}}
{{--                                        <label class="main-content-label tx-13 font-weight-bold mb-1">Total Revenue</label>--}}
{{--                                        <span class="d-block tx-12 mb-0 text-muted">Whole Balance</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="card-item-body">--}}
{{--                                        <div class="card-item-stat">--}}
{{--                                            <h4 class="font-weight-bold">$5,900.00</h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="card-item">
                                    <div class="card-item-icon card-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8 0 1.82.62 3.49 1.64 4.83 1.43-1.74 4.9-2.33 6.36-2.33s4.93.59 6.36 2.33C19.38 15.49 20 13.82 20 12c0-4.41-3.59-8-8-8zm0 9c-1.94 0-3.5-1.56-3.5-3.5S10.06 6 12 6s3.5 1.56 3.5 3.5S13.94 13 12 13z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"/></svg>
                                    </div>
                                    <div class="card-item-title mb-2">
                                        <label class="main-content-label tx-13 font-weight-bold mb-1">Total Clients</label>
                                        <span class="d-block tx-12 mb-0 text-muted">All client from EAC</span>
                                    </div>
                                    <div class="card-item-body">
                                        <div class="card-item-stat">
                                            <?php
//                                            use App\Models\User;
                                            $customer=\App\Models\User::with(['Role'])
                                                ->whereHas(
                                                    'roles', function($q){
                                                    $q->where('name', 'client');
                                                }
                                                )->get();
                                            ?>
                                            <h4 class="font-weight-bold">{{ number_format($customer->count())}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="card-item">
                                    <div class="card-item-icon card-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8 0 1.82.62 3.49 1.64 4.83 1.43-1.74 4.9-2.33 6.36-2.33s4.93.59 6.36 2.33C19.38 15.49 20 13.82 20 12c0-4.41-3.59-8-8-8zm0 9c-1.94 0-3.5-1.56-3.5-3.5S10.06 6 12 6s3.5 1.56 3.5 3.5S13.94 13 12 13z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"/></svg>
                                    </div>
                                    <div class="card-item-title  mb-2">
                                        <label class="main-content-label tx-13 font-weight-bold mb-1">Total Agent</label>
                                        <span class="d-block tx-12 mb-0 text-muted">all Agents</span>
                                    </div>
                                    <div class="card-item-body">
                                        <div class="card-item-stat">
                                            <?php
                                            $agent=\App\Models\User::with(['Role'])
                                                ->whereHas(
                                                    'roles', function($q){
                                                    $q->where('name', 'agent');
                                                }
                                                )->get();
                                            ?>
                                            <h4 class="font-weight-bold">{{number_format($agent->count())}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End row-->


            </div><!-- col end -->
        </div><!-- Row end -->
    @else
        <div class="row row-sm">
            <div class="col-sm-12 col-lg-12 col-xl-8">
                <!--Row-->
                <div class="row row-sm  mt-lg-4">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="card bg-primary custom-card card-box">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="offset-xl-3 offset-sm-6 col-xl-8 col-sm-6 col-12 img-bg ">
                                        <h4 class="d-flex  mb-3" style="display: flex;flex-direction: column">
                                            <span class="font-weight-bold text-white ">{{auth()->user()->name}}</span>
{{--                                            <span class="font-weight-bold text-green ">Your Compte: {{auth()->user()->compte}}</span>--}}
                                            <p class="tx-white-7 mb-1">Your Compte: {{auth()->user()->compte}} </p>
                                        </h4>
                                        <p class="tx-white-7 mb-1">Welcome on Quick Money Transfer </p>
                                    </div>
                                    <img src="{{asset('dashboard/assets/img/pngs/work3.png')}}" alt="user-img" class="wd-200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Row -->
                <div class="row row-sm">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="card-item">
                                            <div class="card-item-icon card-icon">
                                                <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect height="14" opacity=".3" width="14" x="5" y="5"/><g><rect fill="none" height="24" width="24"/><g><path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M19,19H5V5h14V19z"/><rect height="5" width="2" x="7" y="12"/><rect height="10" width="2" x="15" y="7"/><rect height="3" width="2" x="11" y="14"/><rect height="2" width="2" x="11" y="10"/></g></g></g></svg>
                                            </div>
                                            <div class="card-item-title mb-2">
                                                <label class="main-content-label tx-13 font-weight-bold mb-1">My Balance</label>
                                                <span class="d-block tx-12 mb-0 text-muted">Whole Balance</span>
                                            </div>
                                            <div class="card-item-body">
                                                <div class="card-item-stat">
                                                    <?php
                                                    $bal=App\Models\Transaction::where('transfer_id','=',Auth::user()->id)
                                                        ->orWhere('receiver_id','=',Auth::user()->id)
                                                        ->orderBy('id', 'DESC')->first();
                                                    ?>
                                                    @if($bal)
                                                    <h4 class="font-weight-bold">{{Auth::user()->currency}}{{number_format($bal->balances)}}</h4>
                                                        @else
                                                            <h4 class="font-weight-bold">{{Auth::user()->currency}}0</h4>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                        </div>

                    </div>
                </div>
            @endif
        @endsection
        @section('js')


        @endsection

