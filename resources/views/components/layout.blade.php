<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title ?? 'Lib2' }}</title>
        <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    </head>
    <body class="min-h-screen bg-gray-50 font-sans text-black antialiased">
        <div class="mx-auto max-w-2xl px-6 py-24">
            @persist('logo')

            <a
                href="/"
                class="mx-auto flex max-w-max items-center gap-3 font-bold text-[#444] transition hover:opacity-80"
            >
                <img
                    src="/images/logo.svg"
                    alt="Musik Lib"
                    class="mx-auto w-12"
                />
                <span>Musik Lib</span>
            </a>
            @endpersist

            <div class="py-10">{{ $slot }}</div>

            @persist('player')
            <x-player />
            @endpersist
        </div>
    </body>
</html>
