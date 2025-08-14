@extends('layouts.admin')

@section('content')

<div class="row mt-5">
    <div class="col-md-12 col-xxl-8">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Congratulations <span class="fw-bold">{{auth()->user()->name}}</span> 🎉</h4>
                        <p class="mb-0">You have done 68% 😎 more sales today.</p>
                        <p>Check your new badge in your profile.</p>
                        <a href="javascript:;" class="btn btn-primary waves-effect waves-light">View Profile</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                    <div class="card-body pb-0 px-0 pt-2">
                        <img src="{{ url('admin/assets/img/illustrations/illustration-john-light.png') }}" height="186" class="scaleX-n1-rtl" alt="View Profile">
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="row mt-5">

    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card card-border-shadow-info h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">

                        <span class="avatar-initial rounded-3 bg-label-info"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
                    </div>
                    <h4 class="mb-0">4</h4>
                </div>
                <h6 class="mb-0 fw-normal">Total Blogs</h6>

            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card card-border-shadow-danger h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">

                        <span class="avatar-initial rounded-3 bg-label-danger"><i class="fa fa-comments" aria-hidden="true"></i></span>
                    </div>
                    <h4 class="mb-0">3</h4>
                </div>
                <h6 class="mb-0 fw-normal">Total Contact</h6>

            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card card-border-shadow-warning h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">

                        <span class="avatar-initial rounded-3 bg-label-warning"><i class="fa fa-certificate" aria-hidden="true"></i></i></span>
                    </div>
                    <h4 class="mb-0">1</h4>
                </div>
                <h6 class="mb-0 fw-normal">Total Service Order</h6>

            </div>
        </div>
    </div>

</div>
@endsection
