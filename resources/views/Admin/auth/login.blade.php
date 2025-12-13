<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Roksyn Admin</title>

    <!--plugins-->
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">

    <!--Styles-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet">

    <style>
        /* Tambahan styling untuk mempercantik login page */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: transform 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-light:hover {
            transform: translateY(-2px);
            transition: transform 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .alert {
            border-radius: 10px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .input-group-text {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .input-group-text:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body>

    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                <div class="card border-3">
                    <div class="card-body p-5">
                        <img src="{{ asset('assets/images/logo-icon.png') }}" class="mb-4" width="45" alt="">

                        <h4 class="fw-bold">Get Started Now</h4>
                        <p class="mb-0">Enter your credentials to login your account</p>

                        {{-- Tampilkan Pesan Success (misalnya setelah logout) --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Tampilkan Pesan Error (misalnya login gagal) --}}
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                @foreach($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row g-3 my-4">
                            <div class="col-12 col-lg-6">
                                <button
                                    class="btn btn-light py-2 font-text1 fw-bold d-flex align-items-center justify-content-center w-100">
                                    <img src="{{ asset('assets/images/icons/google-2.png') }}" width="18" class="me-2"
                                        alt="">
                                    Log In with Google
                                </button>
                            </div>
                            <div class="col col-lg-6">
                                <button
                                    class="btn btn-light py-2 font-text1 fw-bold d-flex align-items-center justify-content-center w-100">
                                    <img src="{{ asset('assets/images/icons/apple-logo.png') }}" width="18" class="me-2"
                                        alt="">
                                    Log In with Apple
                                </button>
                            </div>
                        </div>

                        <div class="separator section-padding">
                            <div class="line"></div>
                            <p class="mb-0 fw-bold">OR</p>
                            <div class="line"></div>
                        </div>

                        <div class="form-body mt-4">
                            <form method="POST" action="{{ route('login.process') }}">
                                @csrf

                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="inputEmailAddress" value="{{ old('email') }}"
                                        placeholder="jhon@example.com" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="inputChoosePassword" class="form-label">
                                        <i class="bi bi-lock me-2"></i>Password
                                    </label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password"
                                            class="form-control border-end-0 @error('password') is-invalid @enderror"
                                            name="password" id="inputChoosePassword" placeholder="Enter Password"
                                            required>
                                        <a href="javascript:;" class="input-group-text bg-transparent">
                                            <i class="bi bi-eye-slash-fill"></i>
                                        </a>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6 text-end">
                                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                                </div> --}}

                                <div class="col-12 mt-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="text-center">
                                        <p class="mb-0">
                                            Don't have an account yet?
                                            <a href="{{ route('register') }}" class="fw-bold">Sign up here</a>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                let input = $('#show_hide_password input');
                let icon = $('#show_hide_password i');

                if (input.attr("type") === "text") {
                    input.attr('type', 'password');
                    icon.addClass("bi-eye-slash-fill").removeClass("bi-eye-fill");
                } else {
                    input.attr('type', 'text');
                    icon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
                }
            });
        });
    </script>

</body>

</html>