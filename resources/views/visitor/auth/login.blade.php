@extends('visitor/layouts/master')
@section('title','Login')
@section('body')
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-xl-8 py-5 px-md-5">
                    <div class="row pt-md-4">
                        <div class="col-md-12">
                            <form method="POST" action="{{route('visitor.auth.login')}}" class="needs-validation">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" placeholder="Enter Email" class="form-control" name="email" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        Please fill in your email
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
{{--                                        <div class="float-right">--}}
{{--                                            <a href="auth-forgot-password.html" class="text-small">--}}
{{--                                                Forgot Password?--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
                                    </div>
                                    <input id="password" type="password" placeholder="Enter Password" class="form-control" name="password" tabindex="2" required>
                                    <div class="invalid-feedback">
                                        please fill in your password
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                    </button>
                                </div>
                            </form>
                            <div class="mt-5 text-muted text-center">
                                Don't have an account? <a href="{{ route('visitor.register') }}">Create One</a>
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

