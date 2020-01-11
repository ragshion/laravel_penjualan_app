
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Login - - Penjualan App
        </title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="{{ asset('theme/css/vendors.bundle.css') }}">
        <link rel="stylesheet" media="screen, print" href="{{ asset('theme/css/app.bundle.css') }}">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('theme/img/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('theme/img/favicon/favicon-32x32.png') }}">
        <link rel="mask-icon" href="{{ asset('theme/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
        <!-- Optional: page related CSS-->
        <link rel="stylesheet" media="screen, print" href="{{ asset('theme/css/page-login.css') }}">
    </head>
    <body>
        <div class="blankpage-form-field">
            <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                    <img src="{{ asset('theme/img/logo.png') }}" alt="SmartAdmin WebApp" aria-roledescription="logo">
                    <span class="page-logo-text mr-1">Penjualan App</span>
                    <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                </a>
            </div>
            <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="">
                        <span class="help-block">
                            Username anda
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="password" value="">
                        <span class="help-block">
                            Password Anda
                        </span>
                    </div>
                    <button type="submit" class="btn btn-info float-right">Secure login</button>
                </form>
            </div>
        </div>
        <div class="login-footer p-2">
            <div class="row">
                <div class="col col-sm-12 text-center">

                </div>
            </div>
        </div>
        <video poster="{{ asset('theme/img/backgrounds/clouds.png') }}" id="bgvid" playsinline autoplay muted loop>
            <source src="{{ asset('theme/media/video/cc.webm') }}" type="video/webm">
            <source src="{{ asset('theme/media/video/cc.mp4') }}" type="video/mp4">
        </video>
        <!-- base vendor bundle:
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="{{ asset('theme/js/vendors.bundle.js') }}"></script>
        <script src="{{ asset('theme/js/app.bundle.js') }}"></script>
        <!-- Page related scripts -->
    </body>
</html>
