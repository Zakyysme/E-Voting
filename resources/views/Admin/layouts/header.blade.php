<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title', 'Dashboard')</title>

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<!--plugins-->
<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')  }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css')  }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css')  }}" rel="stylesheet">
<!-- loader-->
<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/pace.min.js') }}"></script>
<!--Styles-->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">

<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/semi-dark-theme.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/minimal-theme.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/shadow-theme.css') }}" rel="stylesheet">

@stack('styles')