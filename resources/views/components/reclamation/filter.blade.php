<div x-data="{ open: false }" >

    <style>
        .radio-btn{
            @apply peer-checked:text-black peer-checked:bg-sky-500 p-2 rounded bg-sky-200 cursor-pointer;
        }
    </style>
    <!-- Button to open the modal -->
    <button @click="open = true" class="rounded-[8px] bg-[linear-gradient(90deg,#9EAFCE,#697C9B)] relative flex flex-row p-[4px_18px_4px_19px] box-sizing-border">
      <div class="m-[0.5px_17.9px_0.5px_0] inline-block break-words font-['Inter'] font-medium text-[12px] text-[#FFFFFF]">
        Filter
      </div>
      <div class="bg-[url('../assets/images/filter_11.png')] bg-[50%_50%] bg-cover bg-no-repeat w-[16px] h-[16px]"></div>
    </button>

    <form action="{{route("reclamations")}}" method="GET" enctype="multipart/form-data">
        <!-- Modal -->
        <div x-show="open" @click.away="open = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
          <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Filter Options</h2>
            <div class=" grid grid-cols-4 p-4 m-2 rounded-lg gap-4 grid-rows-1">
                <div>
                    <input type="radio" id="alpha" name="order" value="alphabetical_asc" class="peer hidden">
                    <label for="alpha" class="peer-checked:text-black peer-checked:bg-sky-500 p-2 rounded bg-sky-200 cursor-pointer" >A-Z</label><br>
                </div>
                <div>
                    <input type="radio" id="reverse" name="order" value="alphabetical_desc" class="peer hidden">
                    <label for="reverse"  class="peer-checked:text-black peer-checked:bg-sky-500 p-2 rounded bg-sky-200 cursor-pointer" >Z-A</label><br>
                </div>

                <div>
                    <input type="radio" id="num" name="order" value="numeric_asc" class="peer hidden">
                    <label for="num"  class="peer-checked:text-black peer-checked:bg-sky-500 p-2 rounded bg-sky-200 cursor-pointer" >1-10</label><br>
                </div>


                <div>
                    <input type="radio" id="num_rev" name="order" value="numeric_desc" class="peer hidden">
                    <label for="num_rev"  class="peer-checked:text-black peer-checked:bg-sky-500 p-2 rounded bg-sky-200 cursor-pointer" >10-1</label><br>
                </div>

            </div>
            <div>
                <label for="name"></label>
                <input type="text" name="name" class="p-3 bg-[#f1f1f1] border-solid border-2 border-black rounded-lg" >
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="submit" class="bg-[#3c4c7c] px-3 py-2 rounded-lg text-white">Recherche</button>
                <button @click="open = false" type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Fermer</button>
            </div>
          </div>
        </div>
    </form>
</div>
