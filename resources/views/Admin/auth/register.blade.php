<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Roksyn Admin</title>

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
</head>

<body>

    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-5 mx-auto">
                <div class="card border-3">
                    <div class="card-body p-5">

                        <img src="{{ asset('assets/images/logo-icon.png') }}" class="mb-4" width="45" alt="">
                        <h4 class="fw-bold">Get Started Now</h4>
                        <p class="mb-0">Enter your credentials to create your account</p>

                        <div class="row g-3 my-4">
                            <div class="col-12 col-lg-6">
                                <button
                                    class="btn btn-light py-2 font-text1 fw-bold d-flex align-items-center justify-content-center w-100">
                                    <img src="{{ asset('assets/images/icons/google-2.png') }}" width="18" class="me-2"
                                        alt="">
                                    Sign Up with Google
                                </button>
                            </div>
                            <div class="col col-lg-6">
                                <button
                                    class="btn btn-light py-2 font-text1 fw-bold d-flex align-items-center justify-content-center w-100">
                                    <img src="{{ asset('assets/images/icons/apple-logo.png') }}" width="18" class="me-2"
                                        alt="">
                                    Sign Up with Apple
                                </button>
                            </div>
                        </div>

                        <div class="separator section-padding">
                            <div class="line"></div>
                            <p class="mb-0 fw-bold">OR</p>
                            <div class="line"></div>
                        </div>

                        <div class="form-body mt-4">
                            <form class="row g-3" method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="col-12">
                                    <label for="inputUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="name" id="inputUsername"
                                        placeholder="John" required>
                                </div>

                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="inputEmailAddress"
                                        placeholder="example@user.com" required>
                                </div>

                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" name="password"
                                            id="inputChoosePassword" placeholder="Enter Password" required>
                                        <a href="javascript:;" class="input-group-text bg-transparent">
                                            <i class="bi bi-eye-slash-fill"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="inputSelectCountry" class="form-label">Country</label>
                                    <select class="form-select" name="country" id="inputSelectCountry" required>
                                        <option value="India" selected>India</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="America">America</option>
                                        <option value="Dubai">Dubai</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="terms" type="checkbox"
                                            id="flexSwitchCheckChecked" required>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">
                                            I read and agree to Terms & Conditions
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-start">
                                        <p class="mb-0">
                                            Already have an account?
                                            <a href="{{ route('login') }}">Sign in here</a>
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

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

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