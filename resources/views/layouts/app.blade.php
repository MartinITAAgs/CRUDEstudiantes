<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Universidad Patito</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-600 p-4 text-white shadow-lg">
        <div class="max-w-7xl mx-auto flex gap-6 font-bold">
            <a href="/dashboard">Universidad Patito</a>
            <a href="/carreras">Carreras</a>
            <a href="/estudiantes">Estudiantes</a>
        </div>
    </nav>

    <main class="py-10">
        {{ $slot }}
    </main>
</body>
</html>