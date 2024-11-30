@props([
    'title' => 'Laravel CRUD',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="content">
        {{ $slot }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const forms = document.forms;

            for (const form of forms) {
                const submitBtn = form.querySelector('button[type="submit"]');

                form.addEventListener('submit', () => {
                    if (!submitBtn.hasAttribute('data-prevent-disable')) {
                        submitBtn.disabled = true;
                    }
                });
            }
        });
    </script>

    <script>
        // setTimeout(() => {
        //     console.log('Connected to test');

        //     Echo.channel('test')
        //         .listen('.test-event', (data) => {
        //             console.log('data: ', data);
        //         });
        // }, 3000);
    </script>
</body>

</html>
