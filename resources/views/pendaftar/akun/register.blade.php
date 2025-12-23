<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Pendaftaran Akun</title>
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
            <h3 class="text-center">Form Pendaftaran</h3>
            <p class="text-center">Semua formulir wajib diisi dengan benar</p>
            <div class="login-form">
                <form method="POST" action="{{ route('pendaftar.register') }}">
                    @csrf
                    <div class="form-group form-floating-label">
                        <input id="nama_lengkap" name="nama_lengkap" type="text" class="form-control input-border-bottom" required>
                        <label for="nama_lengkap" class="placeholder">Nama Lengkap</label>
                    </div>

                    <div class="form-group form-floating-label">
                        <input id="nisn" name="nisn" type="number" class="form-control input-border-bottom" required>
                        <label for="nisn" class="placeholder">NISN di Ijazah</label>
                    </div>

                    <div class="form-group form-floating-label">
                        <input id="asal_sekolah" name="asal_sekolah" type="text" class="form-control input-border-bottom" required>
                        <label for="asal_sekolah" class="placeholder">Asal Sekolah</label>
                    </div>

                    <div class="form-group form-floating-label">
                        <input id="no_hp" name="no_hp" type="number" class="form-control input-border-bottom" required>
                        <label for="no_hp" class="placeholder">No HP Aktif</label>
                    </div>

                    <div class="form-action mb-3">
                        <button id="btnLogin" type="submit" class="btn btn-primary btn-rounded btn-login w-100"><i class="fas fa-sign-in-alt"></i> Daftar</button>
                    </div>
                </form>
            </div>
            {{-- <div clas="alert alert-info">
                Pendaftaran Sudah Ditutup, nantikan pendaftaran tahap berikutnya.
            </div> --}}
            <!-- Menampilkan nomor WhatsApp Humas -->
            @if($configPpdb && $configPpdb->no_wa_humas)
                <p class="text-center mt-3">
                    Hubungi WA Humas jika menemui kendala : <a href="https://wa.me/{{ $configPpdb->no_wa_humas }}" target="_blank">{{ $configPpdb->no_wa_humas }}</a>
                </p>
            @endif
            <p class="mt-2 text-center">
                Sudah punya akun? <a href="/pendaftar/login">Masuk Disini</a>
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
            // Ketika form register disubmit
            $('form').on('submit', function(e) {
                // Disable tombol submit agar tidak bisa diklik dua kali
                $('#btnLogin').attr('disabled', true);
    
                // Ubah teks tombol menjadi "Mohon tunggu sedang register..."
                $('#btnLogin').html('<i class="fas fa-spinner fa-spin"></i> Mohon tunggu sedang mendaftarkan...');
            });
        });
    </script>
</body>
</html>
