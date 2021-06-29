@extends('layouts.master')
@section('custom_css')

    @endsection
@section('content')

    <section id="home">
        <div class="container">
            <div class="row align-items-center g-2">
                <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100" src="{{asset('frontend/assets/img/gallery/hero-header.gif')}}" alt="hero-header" /></div>
                <div class="col-md-7 col-lg-6 py-6 text-md-start text-center">
                    <h6 class="fs-0 text-uppercase fw-bold text-600">Top Business App</h6>
                    <h1 class="fw-bold fs-4 fs-lg-6 fs-xxl-7 text-primary"> The plaform for<br />better cooperation</h1>
                    <p class="mb-5 fs-1 fw-medium">Crafted with care &amp; creativity. Brings together <br class="d-none d-xl-block" />everthing in one place.</p><a class="btn hover-top btn-collab" href="#!"><i class="fas fa-download me-2"></i> DOWNLOAD</a><a class="btn hover-top btn-collab-outline text-gradient ms-2" href="#!"> <i class="fas fa-play text-danger me-md-2 me-0"></i> CHECK DEMO</a>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('custom_js')

@endsection
