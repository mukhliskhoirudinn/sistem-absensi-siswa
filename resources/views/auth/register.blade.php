{{-- @extends('layouts.app')

@section('content')
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="col-md-10 col-lg-8"> <!-- Lebar kolom yang lebih besar -->
            <section>
                <div class="card shadow-lg">
                    <div class="row g-0">
                        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                                class="img-fluid" alt="Sample image"
                                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="text-center mb-4 mt-4">
                                    <h1 class="mb-0"
                                        style="font-size: 2.5rem; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                                        <span class="text-primary">Si</span><span class="text-dark fw-bold">Absensi</span>
                                    </h1>
                                    <h5 class="mb-1 text-muted" style="font-size: 16px; margin-bottom: 5px;">Register</h5>
                                </div>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="mb-2">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password-confirm"
                                            class="form-label">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('Register') }}
                                        </button>
                                    </div>

                                    <div class="text-center mt-3">
                                        <p class="small">Already have an account? <a href="{{ route('login') }}"
                                                class="link-danger">{{ __('Login') }}</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection --}}
