{{-- @php
    $user = Auth::user();
    $currentRouteSegment = Request::segment(1); // Get the first segment of the URL
    $residence_name = $user->residences[0]->nomResidence
@endphp --}}


<div
    class="rounded-[20px] bg-[#FFFFFF] relative m-[0_0_29px_0] flex flex-row justify-between p-[20px_13px_20px_20px] w-[1220px] box-sizing-border">
    <div x-data="{ open: false }" class="relative inline-block text-left z-10">
        <div>
            <button @click="open = !open" type="button"
                class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white rounded-md">
                <div
                    class="m-[13.5px_11.5px_13.5px_0] inline-block w-[375px] break-words font-['Fredoka_One','Roboto_Condensed'] font-normal text-[20px] text-[#6F7D93]">
                    Résidence {{ $residence_name }}
                </div>
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M5.293 7.707a1 1 0 011.414 0L10 11.414l3.293-3.707a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Dropdown Panel -->
        <div x-show="open" @click.away="open = false"
            class="absolute right-0 mt-2 w-56 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1">
                @foreach ($user->residences as $residence)
                    <a href=" {{ route('reclamations.residence', $residence->id) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ $residence->nomResidence }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex flex-row box-sizing-border">
        <img src="https://flagcdn.com/w320/ma.png" alt="Moroccan flag" class="w-6 h-4 mr-2">

        <div
            class="m-[6px_20px_6px_0] inline-block text-right break-words font-['Fredoka_One','Roboto_Condensed'] font-normal text-[16px] text-[#6F7D93]">
            Ayoub Daali<br />
            Propriétaire
        </div>
        <div class="rounded-[50px] bg-[url('../assets/images/r_95.jpeg')] w-[50px] h-[50px]">
        </div>
    </div>

</div>
