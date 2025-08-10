@extends('admin.authentication.master')

@section('title')login @endsection

@push('css')
    <style>
        @media(min-width: 1199px){
            .mobile-logo-wrap {
                display: none;
            }
        }
        .mobile-logo-wrap {
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-7 order-1"><img class="bg-img-cover bg-center dektop-logo" src="{{ asset('assets/images/login/1.jpg') }}" alt="looginpage" /></div>
                <div class="col-xl-5 p-0">
                    <div class="login-card">

                        <form class="theme-form login-form needs-validation" novalidate="" method="post" action="{{route('login.details')}}">
                            @method('Post')
                            @csrf
                            <div class="mobile-logo-wrap">
                                <img class="mobile-logo" src="{{ asset('assets/images/logo/logo-1.png') }}" alt="looginpage" />
                            </div>
                            <h4>Login</h4>
                            <h6>Welcome back! Log in to your account.</h6>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="email" required="" placeholder="Test@gmail.com" name="email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password" required="" placeholder="*********" />
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox" />
                                    <label class="text-muted" for="checkbox1">Remember password</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        (function () {
            "use strict";
            window.addEventListener(
                "load",
                function () {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName("needs-validation");
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener(
                            "submit",
                            function (event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add("was-validated");
                            },
                            false
                        );
                    });
                },
                false
            );
        })();
    </script>


    @push('scripts')
        <script>
            @if(Session::has('success'))
                'use strict';
            var notify = $.notify('<i class="fa fa-bell-o"></i><strong>Please Check</strong> Login details are not valid.', {
                type: 'theme',
                allow_dismiss: true,
                delay: 2000,
                showProgressbar: true,
                timer: 700
            });
            setTimeout(function() {
                notify.update('message', '<i class="fa fa-bell-o"></i><strong>Please Check</strong> Login details are not valid.');
            }, 1000);
            @endif
        </script>
    @endpush

@endsection
