<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – @yield('title')</title>

    <!-- TailwindCSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Wrapper -->
    <div class="flex">

        {{-- Sidebar Admin --}}
        @include('admin.layout.sidebar')

        <!-- Content -->
        <div class="flex-1 min-h-screen flex flex-col">

            {{-- Header Admin --}}
            @include('admin.layout.header')

            <!-- Main Content -->
            <main class="p-6">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('admin.layout.footer')
        </div>
    </div>

</body>
</html>