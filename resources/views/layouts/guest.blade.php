<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inovice Digitaliz</title>
    <link rel="icon" type="image/png" href="{{ asset('dist') }}/assets/img/login/logo_digitaliz.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100">

        <div class="w-full bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    {{--  Kode javascript untuk lihat password pada Halaman Register  --}}
    <script>
        document.getElementById("togglePassword").addEventListener("click", showPassword);
        document.getElementById("togglePassword2").addEventListener("click", showPassword);

        function showPassword(event) {
            event.preventDefault();
            var passwordInput = document.getElementById("password");
            var confirmPasswordInput = document.getElementById("password_confirmation");
            if (passwordInput.type === "password" || confirmPasswordInput.type === "password") {
                passwordInput.type = "text";
                confirmPasswordInput.type = "text";
            } else {
                passwordInput.type = "password";
                confirmPasswordInput.type = "password";
            }
            event.preventDefault();
        }
    </script>
    <script>
        const resetPasswordButton = document.querySelector("#reset-password");
        resetPasswordButton.addEventListener("click", function() {
            const spinner = document.createElementNS("http://www.w3.org/2000/svg", "svg");
            spinner.setAttribute("class", "animate-spin h-6 w-6 text-white mr-1.5 spinner");
            spinner.setAttribute("xmlns", "http://www.w3.org/2000/svg");
            spinner.setAttribute("viewBox", "0 0 24 24");
            spinner.innerHTML =
                "<path class='opacity-75' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-dasharray='89, 200' stroke-dashoffset='0' d='M12,2a10,10 0 1,0 10,10a10,10 0 0,1-10,10a10,10 0 0,1-10,-10a10,10 0 0,1 10,-10z'/>";
            const processing = document.createElement("div");
            processing.setAttribute("class", "processing");
            processing.innerText = "Processing...";
            resetPasswordButton.innerHTML = '';
            resetPasswordButton.appendChild(spinner);
            resetPasswordButton.appendChild(processing);
        });
    </script>

    {{--  Kode untuk submit dengan Enter pada Login Page  --}}
    <script>
        const form = document.querySelector('form');
        const passwordInput = document.getElementById('passwordLogin');
        passwordInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                form.submit();
            }
        });
    </script>


    {{--  Kode javascript untuk lihat password pada Halaman Register  --}}
    <script>
        document.getElementById("togglePassword3").addEventListener("click", showPasswordLogin);

        function showPasswordLogin(event) {
            event.preventDefault();
            var passwordInput = document.getElementById("passwordLogin");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>

</html>
