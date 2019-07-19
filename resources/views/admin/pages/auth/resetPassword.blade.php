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
                    <div class="auth-form w-xl-30 w-sm-50 w-100">
                        <a class="auth-brand text-center d-block mb-20" href="#">
                            <img class="brand-img" src="dist/img/logo-light.png" alt="brand" />
                        </a>
                        <form>
                            <h1 class="display-5 mb-30 text-center">Please reset your password</h1>
                            <div class="form-group">
                                <input class="form-control" placeholder="New password" type="password">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" placeholder="Re-enter new password" type="password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-pink btn-block mb-20" type="submit">Reset Password</button>
                            <p class="text-right"><a href="#">Back to login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
