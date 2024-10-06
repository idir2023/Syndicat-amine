@extends('layouts.main')

@section('content')
    {{-- Navbar --}}
    <x-layouts.navbar :user="Auth::user()" route="dashboard.residence"></x-layouts.navbar>

    <!-- Main content -->
    <div class="flex-1 p-8">

        <!-- Statistics Section -->
        <div class="grid grid-cols-6 gap-4 mb-10">
            @foreach ($roleCounts as $role => $count)
                @if (Auth::user()->hasAnyRole(['superadmin', 'admin']) ||
                        (Auth::user()->hasAnyRole(['manager principal', 'manager']) && !in_array($role, ['superadmin', 'admin'])))
                    <div class="bg-white p-6 rounded-xl shadow-md text-center">
                        <p class="text-sm text-gray-500 mb-2">{{ $role }}</p>
                        <h2 class="text-3xl font-bold">{{ $count }}</h2>
                    </div>
                @endif
            @endforeach

            {{--  --}}
            @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
                <div class="bg-white p-6 rounded-xl shadow-md text-center">
                    <p class="text-sm text-gray-500 mb-2">Résidence</p>
                    <h2 class="text-3xl font-bold">{{ $residences }}</h2>
                </div>
            @endif
        </div>

        <div class="flex justify-between space-x-8">
            <!-- Contacts Section -->
            <div class="w-2/3 bg-white rounded-xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Contacts utiles</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-gray-600 text-sm font-semibold">GESTIONNAIRE</th>
                                <th class="px-6 py-3 text-left text-gray-600 text-sm font-semibold">ADRESSE</th>
                                <th class="px-6 py-3 text-left text-gray-600 text-sm font-semibold">RÔLE</th>
                                <th class="px-6 py-3 text-left text-gray-600 text-sm font-semibold">TÉLÉPHONE</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700">
                            @forelse ($users as $user)
                                @if (Auth::user()->hasAnyRole(['superadmin', 'admin']))
                                    <tr>
                                        <td class="px-6 py-4 flex items-center space-x-3">
                                            <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-full">
                                            <div>
                                                <span>{{ $user->prenom }} {{ $user->nom }}</span><br>
                                                <a href="mailto:{{ $user->email }}"
                                                    class="text-xs text-blue-500">{{ $user->email }}</a>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">Immeuble {{ $user->Num_Immenble }}, Appartement
                                            {{ $user->Num_Appartement }}</td>
                                        <td class="px-6 py-4">{{ optional($user->roles->first())->name }}</td>
                                        <td class="px-6 py-4">{{ $user->phone }}</td>
                                    </tr>
                                @else
                                    @if (optional($user->roles->first())->name !== 'admin' && optional($user->roles->first())->name !== 'superadmin')
                                        <tr>
                                            <td class="px-6 py-4 flex items-center space-x-3">
                                                <img src="https://via.placeholder.com/30" alt="Profile"
                                                    class="rounded-full">
                                                <div>
                                                    <span>{{ $user->prenom }} {{ $user->nom }}</span><br>
                                                    <a href="mailto:{{ $user->email }}"
                                                        class="text-xs text-blue-500">{{ $user->email }}</a>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">Immeuble {{ $user->Num_Immenble }}, Appartement
                                                {{ $user->Num_Appartement }}</td>
                                            <td class="px-6 py-4">{{ optional($user->roles->first())->name }}</td>
                                            <td class="px-6 py-4">{{ $user->phone }}</td>
                                        </tr>
                                    @endif
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center">Aucun utilisateur trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- InfoCom Section -->
            <div class="w-1/3 bg-white rounded-xl shadow-md p-6">
                <!-- Title and Date -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">InfoCom</h2>
                    <span class="text-gray-400 text-xs">{{ now()->format('d/m/Y') }}</span>
                </div>

                @php
                    // Get the latest date from the infoComs
                    $latestDate = $infoComs->max('date_info');
                @endphp

                <ul class="space-y-4 text-gray-600 text-sm">
                    @foreach ($infoComs as $infoCom)
                        <li class="flex items-start space-x-2">
                            @if ($infoCom->date_info === $latestDate)
                                <span class="text-green-500">🟢</span>
                            @endif
                            <div>
                                <p class="font-medium text-indigo-600">{{ $infoCom->titre }}</p>
                                <p class="text-gray-400 text-xs">{{ $infoCom->date_info }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>

    </div>
@endsection
