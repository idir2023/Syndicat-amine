@extends('layouts.main')
@php
    use App\Http\Controllers\TimeFunction;
@endphp

@section('content')
    <div class="w-full">
        <x-layouts.navbar :user="Auth::user()" route="document.residence"></x-layouts.navbar>

        <div class="flex flex-col w-full px-6 space-y-4 ">

            <!-- First layout -->
            <div class="w-full  rounded-lg flex flex-row justify-between items-center ">
                <!-- Content for the first layout -->
                <div class="flex-1 rounded-lg z-20">
                    <div x-data="{ open: false }" class="  flex flex-row justify-start  relative ">
                        <button @click="open = !open" type="button">
                            <div
                                class="relative m-[3px_8.5px_4px_0]  w-full break-words font-['Inter'] font-semibold text-[14px] text-[#3C4C7C] flex justify-between">
                                Touts les types
                                <div
                                    class="bg-[url('../assets/images/arrow_down_sign_to_navigate_1.png')] bg-[50%_50%] bg-cover bg-no-repeat m-[7px_0_1px_0] w-[16px] h-[16px]">
                                </div>
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class=" w-56 absolute  mt-2 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none">
                            <a href="{{ route('document.type', ['type' => 'tous', 'residence' => $residence->id]) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Tous
                            </a>
                            @foreach ($types as $type)
                                <a href="{{ route('document.type', ['type' => $type, 'residence' => $residence->id]) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ $type }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex-1 rounded-lg flex justify-end">

                    <button
                        class="rounded-[8px] bg-[linear-gradient(90deg,#9EAFCE,#697C9B)] relative flex flex-row p-[4px_18px_4px_19px] box-sizing-border">
                        <div
                            class="m-[0.5px_17.9px_0.5px_0] inline-block break-words font-['Inter'] font-medium text-[12px] text-[#FFFFFF]">
                            Filter
                        </div>
                        <div
                            class="bg-[url('../assets/images/filter_11.png')] bg-[50%_50%] bg-cover bg-no-repeat w-[16px] h-[16px]">
                        </div>
                    </button>

                </div>
            </div>
        </div>

        <!-- Second layout -->
        <div class="w-full p-4 rounded-lg ">
            <!-- Content for the second layout -->
                <div class="flex flex-row w-full box-sizing-border ">
                    {{-- ---------------------------------------------PDF reader -------------------------------------------------------- --}}
                    @if ($documents && $documents->isNotEmpty())
                        <div
                            class="rounded-[20px] bg-[#FFFFFF] relative m-[0_20px_0_0] p-[17.5px_20px_20px_15px] w-full h-screen box-sizing-border ">
                            {{-- ----------------------------------------------------chose the document---------------------------------------------------------------------- --}}
                            <div x-data="{ open: false }" class="  flex flex-row justify-start  relative z-10 ">
                                <button @click="open = !open" type="button">
                                    <div
                                        class="relative m-[3px_8.5px_4px_0]  w-[200px] break-words font-['Inter'] font-semibold text-[14px] text-[#3C4C7C] flex justify-between">
                                        Touts les documents
                                        <div
                                            class="bg-[url('../assets/images/arrow_down_sign_to_navigate_1.png')] bg-[50%_50%] bg-cover bg-no-repeat m-[7px_0_1px_0] w-[16px] h-[16px]">
                                        </div>
                                    </div>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    class=" w-56 absolute  mt-2 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    style="display: none">

                                    @foreach ($documents as $document)
                                        <button
                                            onclick="changePDF( '{{ asset($document->fichier) }}' , '{{ $document->titre }}' , '{{ $document->created_at }}' )"
                                            type="button" class=" block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">
                                            {{ $document->titre }}
                                        </button>
                                    @endforeach


                                </div>
                            </div>
                            {{-- -------------------------------------------------------------------------------------------------------------------------- --}}
                            <div class="grid grid-cols-2">
                                <div class="text-left	">
                                    <span class="break-words font-['Inter'] font-normal text-[12px] text-[#6F7D93]"
                                        id="title">
                                        {{ $document->titre }}
                                    </span>
                                </div>

                                <div class="text-right	">
                                    <span class="break-words font-['Inter'] font-normal text-[12px] text-[#6F7D93]"
                                        id="card-date">
                                        {{ TimeFunction::formatDateToFrench($document->created_at) }}
                                    </span>
                                </div>
                            </div>


                            <div class="p-5 w-full h-full ">
                                <embed id="pdf-viewer" src="{{ asset($document->fichier) }}" class="w-full h-full" />
                            </div>

                        </div>
                    @endif

                    {{-- ---------------------------------------------add pdf -------------------------------------------------------- --}}

                    @role('superadmin|admin|manager principal|manger')
                        <x-document.form-ajouter-document :residence="$residence->id"></x-document.form-ajouter-document>
                    @endrole
                </div>
        </div>

    </div>





    <script>
        function changePDF(pdflink, titre, date) {
            // Set the PDF link
            document.getElementById('pdf-viewer').src = pdflink;

            // Set the title
            document.getElementById('title').innerHTML = titre;

            // Format the date
            const date_ = new Date(date);
            const formattedDate = date_.toLocaleDateString('fr-FR', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            // Set the formatted date
            document.getElementById('card-date').innerHTML = formattedDate;
        }
    </script>
    </div>


@endsection
