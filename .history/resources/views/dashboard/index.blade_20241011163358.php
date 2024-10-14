@extends('layouts.main')

@section('content')
    {{-- Navbar --}}
    <x-layouts.navbar :user="Auth::user()" route="dashboard.residence"></x-layouts.navbar>

    <!-- Main content -->
    <div class="flex-1 p-8">

        <!-- Statistics Section -->
        <div class="grid grid-cols-6 gap-4 mb-10">
            @foreach ($roleCounts as $role => $count)
                @if (Auth::user()->hasAnyRole(['Super Admin', 'Admin']) ||
                        (Auth::user()->hasAnyRole(['Manager principal', 'Manager']) && !in_array($role, ['Super Admin', 'Admin'])))
                    <div
                        class="bg-white p-6 rounded-xl shadow-md text-center transition-transform transform hover:scale-105">
                        <p class="text-sm text-gray-500 mb-2">{{ __('' . $role) }}</p>
                        <h2 class="text-3xl font-bold text-indigo-600">{{ $count }}</h2>
                    </div>
                @endif
            @endforeach

            @if (Auth::user()->hasAnyRole(['Super Admin', 'Admin']))
                <div class="bg-white p-6 rounded-xl shadow-md text-center transition-transform transform hover:scale-105">
                    <p class="text-sm text-gray-500 mb-2">{{ __('Residence') }}</p>
                    <h2 class="text-3xl font-bold text-indigo-600">{{ $residences }}</h2>
                </div>
            @endif
        </div>


        <div class="flex justify-between space-x-8">
            <!-- Contacts Section -->
            <div class="w-2/3 bg-white rounded-xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">{{ __('Useful Contacts') }}</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-gray-600 text-sm font-semibold">
                                    {{ __('Manager') }}</th>
                                <th class="px-6 py-3 text-left text-gray-600 text-sm font-semibold">
                                    {{ __('Address') }}</th>
                                <th class="px-6 py-3 text-left text-gray-600 text-sm font-semibold">
                                    {{ __('Role') }}</th>
                                <th class="px-6 py-3 text-left text-gray-600 text-sm font-semibold">
                                    {{ __('Phone') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700">
                            @forelse ($users as $user)
                                @if (Auth::user()->hasAnyRole(['Super Admin', 'Admin']))
                                    <tr>
                                        <td class="px-6 py-4 flex items-center space-x-3">
                                             <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/images/avatar.png') }}"
                                    alt="User Profile" class="rounded-[8px] w-[40px] h-[40px] bg-cover bg-center">
                                            {{-- <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-full"> --}}
                                            <div>
                                                <span>{{ $user->prenom }} {{ $user->nom }}</span><br>
                                                <a href="mailto:{{ $user->email }}"
                                                    class="text-xs text-blue-500">{{ $user->email }}</a>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">{{ __('Building') }} {{ $user->Num_Immenble }},
                                            {{ __('Apartment') }} {{ $user->Num_Appartement }}</td>
                                        <td class="px-6 py-4">
                                            {{ __('' . optional($user->roles->first())->name) }}</td>
                                        <td class="px-6 py-4">{{ $user->phone }}</td>
                                    </tr>
                                @else
                                    @if (optional($user->roles->first())->name !== 'Admin' && optional($user->roles->first())->name !== 'Super Admin')
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
                                            <td class="px-6 py-4">{{ __('Building') }} {{ $user->Num_Immenble }},
                                                {{ __('Apartment') }} {{ $user->Num_Appartement }}</td>
                                            <td class="px-6 py-4">
                                                {{ __('' . optional($user->roles->first())->name) }}</td>
                                            <td class="px-6 py-4">{{ $user->phone }}</td>
                                        </tr>
                                    @endif
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center">{{ __('No users found.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tbody class="divide-y divide-gray-200 text-gray-700">
    @if (!empty($users) && $users->count() > 0)
        @foreach ($users as $user)
            <tr class="border-b">
                <td class="px-6 py-4 flex items-center space-x-3">
                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/images/avatar.png') }}"
                        alt="User Profile" class="rounded-[8px] w-[40px] h-[40px] bg-cover bg-center">
                    <div>
                        <span class="font-['Inter'] font-semibold text-[12px] text-[#3A416F]">
                            {{ $user->prenom }} {{ $user->nom }}</span><br>
                        <a href="mailto:{{ $user->email }}"
                            class="text-xs text-blue-500">{{ $user->email }}</a>
                    </div>
                </td>
                <td class="px-6 py-4 text-left">
                    <p class="font-['Inter'] font-semibold text-[12px] text-[rgba(58,65,111,0.8)]">
                        Immeuble {{ $user->Num_Immenble }}</p>
                    <p class="text-[12px] text-[#6F7D93]">Appartement {{ $user->Num_Appartement }}</p>
                </td>
                <td class="px-6 py-4 text-center">
                    @foreach ($user->roles as $role)
                        <span class="bg-[#EAF9F0] text-[#6F7D93] px-2 py-1 rounded-full text-[10px] font-['Inter']">{{ $role->name }}</span>
                    @endforeach
                </td>
                @role('Super Admin|Admin|Manager principal|Manager')
                    <td class="px-6 py-4 text-center font-['Inter'] text-[12px] text-[#3A416F]">
                        {{ $user->phone }}
                    </td>
                    <td class="px-6 py-4 text-center text-red-600 cursor-pointer">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="font-['Inter'] text-[12px] text-[#6F7D93] hover:text-[#3e4044]">Supprimer</button>
                        </form>
                    </td>
                @endrole
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5" class="px-6 py-4 text-center">{{ __('No users found.') }}</td>
        </tr>
    @endif
</tbody>

                    </table>
                </div>
            </div>

            <!-- InfoCom Section -->
            <div class="w-1/3 bg-white rounded-xl shadow-md p-6">
                <!-- Title and Date -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">{{ __('InfoCom') }}</h2>
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
                                <span class="text-green-500 text-xl">🟢</span>
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