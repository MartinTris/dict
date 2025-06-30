<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DICT Cavite Monitoring - Login</title>

    <!-- Fonts and styles -->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600,700,900" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #003566, #35478c);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Nunito', sans-serif;
        }

        .header {
            background-color: #002349;
            color: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            justify-content: space-between;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .header img {
            height: 50px;
        }

        .login-container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .bg-image {
            background-image: url('/images/dict.png');
            background-size: 60%;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 500px;
        }

        .card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.90);
            /* White with slight transparency */
            backdrop-filter: blur(15px);
            /* Glassmorphism effect */
            -webkit-backdrop-filter: blur(15px);
            /* Safari compatibility */
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.18);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        .form-control-user {
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid #ccc;
            padding: 12px 15px;
            transition: 0.3s ease;
        }

        .form-control-user:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-user {
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
        }

        .text-primary {
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
        }

        .card-body .text-center h1 {
            font-weight: 700;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            color: #003566;
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        .password-toggle:hover {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .bg-image {
                display: none !important;
            }

            .header h2 {
                font-size: 18px;
            }
        }
    </style>

</head>

<body>
    <!-- Content Wrapper -->
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
    @yield('scripts')
</body>

</html>