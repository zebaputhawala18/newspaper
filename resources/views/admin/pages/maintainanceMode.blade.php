@extends('admin.layout.app')

@section('adminContent')
    <header class="d-flex justify-content-end align-items-center">
        <div class="btn-group btn-group-sm">
            <a href="#" class="btn btn-outline-secondary">Help</a>
            <a href="#" class="btn btn-outline-secondary">About Us</a>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 pa-0">
                <div class="auth-form-wrap pt-xl-0 pt-70">
                    <div class="auth-form w-xl-25 w-lg-30 w-sm-50 w-100">
                        <a class="auth-brand text-center d-block mb-45" href="#">
                            <img class="brand-img" src="dist/img/logo-light.png" alt="brand" />
                        </a>
                        <form>
                            <div class="d-62 bg-white rounded-circle mb-10 d-flex align-items-center justify-content-center mx-auto">
                                <i class="zmdi zmdi-settings font-28"></i>
                            </div>
                            <h1 class="display-4 mb-10 text-center">Sorry we are down for maintenance</h1>
                            <p class="mb-30 text-center">We apologize for the inconvenience, we are doing our best to get things back in order for you. Please feel free to <a href="#"><u>contact us</u></a> for any queries.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
