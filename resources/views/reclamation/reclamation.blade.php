@extends('layouts.main')

@section('content')
    <x-layouts.navbar :user="Auth::user()" route="reclamations.residence"></x-layouts.navbar>

    <div class="flex flex-col w-full">

        <!-- First layout -->
        <div class="pb-[27px] flex flex-row justify-between w-full">
            <!-- Content for the first layout -->
            <div class="flex-1 text-white rounded-lg">
                <div
                    class="m-[3px_8.5px_4px_0] inline-block w-[409px] break-words font-['Inter'] font-semibold text-[14px] text-[#3C4C7C]">
                    Sinistres et Nuisances Déclarés au Sein de la Résidence
                </div>
            </div>
            <div class="flex-1 text-white rounded-lg flex justify-end">
                <x-reclamation.filter></x-reclamation.filter>
            </div>
        </div>

        <!-- Second layout (Reclamations List) -->
        <div class="flex flex-row justify-between">
            <div id="reclamations" class="flex flex-col items-center pr-[20px] w-full">
                @if (isset($reclamations) && $reclamations->isNotEmpty())
                    @foreach ($reclamations as $post)
                        <x-reclamation.card-post :data="$post" :user="$user"></x-reclamation.card-post>
                    @endforeach
                @else
                    <p>Aucune réclamation trouvée.</p>
                    <script>
                        document.getElementById('reclamations').classList.add('hidden');
                    </script>
                @endif

                <div class="mt-4 w-full flex justify-center">
                    {{ $reclamations->links('vendor.pagination.tailwind') }} <!-- Adjust pagination style if needed -->
                </div>
            </div>

            <!-- Third layout (Form) -->
            @if (isset($residence_id))
                <x-reclamation.form-ajoute-declaration postUrl="reclamations.store"
                    :residence="$residence_id"></x-reclamation.form-ajoute-declaration>
            @else
                <p>Aucun résident trouvé.</p>
            @endif
        </div>

    </div>

@endsection
