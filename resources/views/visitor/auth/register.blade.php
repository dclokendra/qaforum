@extends('visitor/layouts/master')
@section('title','Register')
@section('body')
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-xl-8 py-5 px-md-5">
                    <div class="row pt-md-4">
                        <div class="col-md-12">
                            <form action="{{route('visitor.register.store')}}"  method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" placeholder="Enter your Name" class="form-control" name="name" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" placeholder="Enter your Email" class="form-control" name="email" required>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="password" placeholder="Enter Password" class="form-control pwstrength" data-indicator="pwindicator"
                                               name="password">
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2" class="d-block">Password Confirmation</label>
                                        <input id="password2" type="password" class="form-control" placeholder="Re-type Password" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                        <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Register
                                    </button>
                                </div>
                            </form>
                            <div class="mb-4 text-muted text-center">
                                Already Registered? <a href="{{ route('visitor.auth.login') }}">Login</a>
                            </div>
                        </div>

                    </div><!-- END-->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection

