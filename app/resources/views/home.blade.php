<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ribarnica</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-50 min-h-screen flex flex-col items-center justify-start p-6">

    <header class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-blue-800">Dobrodošli u Ribarnicu!</h1>
        <p class="text-gray-700 mt-2">Sveže ribe direktno sa mora!</p>
    </header>

    <main class="w-full max-w-xl bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">Ribe na prodaju:</h2>

        <ul class="space-y-2">
            @foreach($fish as $f)
                <li class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="font-medium text-gray-800">{{ $f->name }}</span>
                    <span class="text-gray-600">{{ $f->price }} RSD</span>
                </li>
            @endforeach
        </ul>
    </main>

    <footer class="mt-8 text-gray-500 text-sm">
        &copy; 2025 Ribarnica. Sva prava zadržana.
    </footer>

</body>

</html>