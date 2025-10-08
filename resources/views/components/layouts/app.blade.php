<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{ $slot }}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle SweetAlert from session
            @if (session('swal'))
                const swalData = @json(session('swal'));
                Swal.fire({
                    title: swalData.title,
                    text: swalData.text,
                    icon: swalData.icon,
                    confirmButtonColor: swalData.icon === 'success' ? '#0891b2' : swalData.icon ===
                        'error' ? '#dc2626' : swalData.icon === 'warning' ? '#f59e0b' : '#6b7280',
                    timer: swalData.icon === 'success' ? 3000 : null,
                    timerProgressBar: swalData.icon === 'success' ? true : false
                });
            @endif
        });
    </script>
</body>

</html>
