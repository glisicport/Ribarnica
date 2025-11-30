<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Button</title>

    <!-- CDN Tailwind (bez build-a, bez CSS fajlova) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <form action="/odjava" method="POST">
        <!-- Laravel CSRF -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <button
            type="submit"
            class="px-6 py-3 bg-red-600 text-white rounded-md 
                   hover:bg-red-700 active:bg-red-800 
                   shadow-md hover:shadow-lg transition-all duration-200
                   font-semibold"
        >
            Odjava
        </button>
    </form>

</body>
</html>
