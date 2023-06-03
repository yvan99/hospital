@include('components.dashcss')

<body class="">
    <div class="wrapper">
        <section class="login-content overflow-hidden">
            <div class="row no-gutters align-items-center auth-screen" style="background: #300074">
                <div class="col-md-12 col-lg-12 align-self-center">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="card auth-card  d-flex justify-content-center mb-0">
                                <div class="card-header">
                                    <h3>{{ __('Nurse Login') }}</h3>
                                </div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('nurse.login.submit') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="email"
                                                class=" text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-12">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class=" text-md-right">{{ __('Password') }}</label>

                                            <div class="col-md-12">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-warning">
                                                    {{ __('Login') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    @include('components.dashjs')
