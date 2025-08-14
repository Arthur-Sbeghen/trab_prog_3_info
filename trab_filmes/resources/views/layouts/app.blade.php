<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media (max-width: 495px) {
            .logged {
                display: none;
            }
        }
    </style>
    <link rel="icon" href="{{ asset('storage/logo/icon.png') }}" type="image/x-icon">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function showAlert(message, type) {
                    if (message && type) {
                        Swal.fire({
                            title: message,
                            icon: type,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            toast: true,
                            position: 'bottom-end',
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            },
                            iconColor: 'white',
                            color: 'white',
                            customClass: {
                                popup: 'colored-toast',
                            },
                        });
                    }
                }
                function showConfirm(e, message, type) {
                    e.preventDefault()
                    Swal.fire({
                        title: "Are you sure?",
                        text: `You won't be able to recover the "${message}" ${type}!`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#b8e158",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                        theme: 'dark',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            e.target.submit();
                        }
                    });

                    return false
                }
            </script>
            {{ $slot }}
            <script>
                document.querySelectorAll('.submit').forEach( btn => {
                    btn.closest('form').addEventListener('submit', function () {
                        btn.disabled = true;
                    })
                })
                document.querySelectorAll('nav').forEach(nav => {
                    if (nav.getAttribute('role') === 'navigation') {
                        nav.setAttribute("class", "nav-page");
                        Array.from(nav.children).forEach(child => {
                            child.setAttribute("class", "btn-type2");
                        });
                    }
                });
            </script>
        </main>
    </div>
</body>

</html>