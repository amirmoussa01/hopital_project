<aside class="w-64 bg-gray-900 text-white min-h-screen">

    <!-- Logo -->
    <div class="p-6 text-center border-b border-gray-700">
        <h2 class="text-2xl font-bold">🏥 Hôpital</h2>
        <p class="text-sm text-gray-400">Admin Panel</p>
    </div>

    <!-- Menu -->
    <nav class="mt-6">
        <ul class="space-y-2">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-6 py-3 hover:bg-gray-700">
                   📊 Dashboard
                </a>
            </li>

            <li class="text-gray-400 px-6 pt-4">Gestion</li>

            <li>
                <a href="{{ route('admin.patients.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700">
                   👤 Patients
                </a>
            </li>

            <li>
                <a href="{{ route('admin.medecins.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700">
                   🩺 Médecins
                </a>
            </li>

            <li>
                <a href="{{ route('admin.salles.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700">
                   🏢 Salles
                </a>
            </li>

            <li>
                <a href="{{ route('admin.consultations.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700">
                   📚 Consultations
                </a>
            </li>

            <li>
                <a href="{{ route('admin.hospitalisations.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700">
                   🛏️ Hospitalisations
                </a>
            </li>

            <li>
                <a href="{{ route('admin.ordonnances.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700">
                   💊 Ordonnances
                </a>
            </li>

            <li>
                <a href="{{ route('admin.examens.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700">
                   🔬 Examens
                </a>
            </li>

        </ul>
    </nav>

</aside>