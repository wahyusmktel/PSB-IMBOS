<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login Operator</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('img/icon.ico') }}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset("assets/css/fonts.min.css") }}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atlantis.css') }}">
</head>
<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <div class="d-flex justify-content-center align-items-center" style="height: 25vh;">
                <div class="avatar avatar-xxl">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="avatar-img rounded-circle">
                </div>
            </div>            
            <h3 class="text-center">Login Operator</h3>
            <p class="text-center">Silahkan Masukan Username dan Password</p>
            <div class="login-form mt-2">
                <form method="POST" action="{{ route('operator.login.post') }}">
                    @csrf
                    <div class="form-group form-floating-label">
                        <input id="username" name="username" type="text" class="form-control input-border-bottom" required>
                        <label for="username" class="placeholder">Masukan Username</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="password" name="password" type="password" class="form-control input-border-bottom" required>
                        <label for="password" class="placeholder">Masukan Password</label>
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
                    </div>
                    <div class="row form-sub m-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberme" name="remember">
                            <label class="custom-control-label" for="rememberme">Ingat Saya</label>
                        </div>
                    </div>
                    <div class="form-action mb-3">
                        <button id="btnLogin" type="submit" class="btn btn-primary btn-rounded btn-login w-100">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </button>
                    </div>
                </form>
            </div>
            <!-- Menampilkan nomor WhatsApp Humas -->
            <p class="text-center mt-3">
                Hubungi WA Administrator jika menemui kendala.
            </p>
        </div>
    </div>

    <!-- JS Files -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/atlantis.min.js') }}"></script>
    <!-- Script to handle SweetAlert -->
    @include('sweetalert::alert')

    <script>
        $(document).ready(function() {
            // Ketika form login disubmit
            $('form').on('submit', function(e) {
                // Disable tombol submit agar tidak bisa diklik dua kali
                $('#btnLogin').attr('disabled', true);
    
                // Ubah teks tombol menjadi "Mohon tunggu sedang login..."
                $('#btnLogin').html('<i class="fas fa-spinner fa-spin"></i> Mohon tunggu sedang login...');
            });
        });
    </script>

</body>
</html>
