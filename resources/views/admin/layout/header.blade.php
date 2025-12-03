<header class="bg-white shadow px-6 py-4 flex justify-between items-center">

    <h1 class="text-xl font-bold text-gray-700">Panneau d’administration</h1>

    <div class="flex items-center gap-4">

        <span class="text-gray-600">Bonjour, {{ auth()->user()->name }}</span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Déconnexion
            </button>
        </form>

    </div>
</header>