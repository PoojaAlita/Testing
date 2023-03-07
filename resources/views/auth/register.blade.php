@extends('layouts.master2')
@section('title',"Registration")
@section('content')

<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="bg-primary">
                        <div class="text-primary text-center p-4">
                            <h5 class="text-white font-size-20">Free Register</h5>
                            <p class="text-white-50">Get your free Veltrix account now.</p>
                            <a href="index.html" class="logo logo-admin">
                                <img src="{{asset('admin/assets/images/logo-sm.png')}}" height="24" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                            <form method="POST" class="mt-4" action="{{ route('register') }}" id="registration">
                                @csrf
                                <div class="p-3">
                                 @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                   @endif

                                <input type="hidden" id="id" name="id">
                                <div class="mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="user_name" placeholder="Enter UserName" autocomplete="off">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="useremail">Email</label>
                                    <input type="email" class="form-control" id="useremail" name="email" placeholder="Enter Email" autocomplete="off">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">Password</label>
                                    <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter Password" autocomplete="off">
                                </div>
                                
                                <div class="mb-3 row">
                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>

                                <div class="mt-2 mb-0 row">
                                    <div class="col-12 mt-4">
                                        <p class="mb-0">By registering you agree to the Veltrix <a href="#" class="text-primary">Terms of Use</a></p>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

                <div class="mt-5 text-center">
                    <p>Already have an account ? <a href="{{route('login')}}" class="fw-medium text-primary"> Login </a> </p>
                    <p>© <script>document.write(new Date().getFullYear())</script> Veltrix. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('custome-script')
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/registration_validation.js')}}"></script>
@endsection
