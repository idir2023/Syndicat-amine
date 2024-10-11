<div class="flex flex-row justify-between w-full"> <!-- Conteneur flex -->
    <div class="flex flex-col items-center pr-[20px] w-full"> <!-- Bloc pour afficher les informations -->
        <!-- Placez ici le contenu principal, par exemple les déclarations existantes -->
        <!-- @foreach ($declarations as $declaration) -->
            <!-- Affichage des déclarations -->
        <!-- @endforeach -->
    </div>

    @role('superadmin|admin|manager principal|manger')
    <div class="w-full max-w-[330px]"> <!-- Conteneur pour le formulaire -->
        <form method="post" action="{{ route($postUrl) }}" enctype="multipart/form-data">
            @csrf

            <div class="shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] rounded-[20px] bg-[#FFFFFF] relative m-[0_0_198px_0] flex flex-col p-[16.5px_0_16px_0] box-sizing-border">
                <div class="m-[0_25px_26.5px_25px] inline-block self-start break-words font-['Inter'] font-semibold text-[14px] text-[#3C4C7C]">
                    Ajouter Votre Déclaration
                </div>
                <!-- display the messages and errors -->
                <!-- <div class="px-2"> -->
                <!--     <x-error.message ></x-error.message> -->
                <!-- </div> -->

                <div class="bg-[#F7F7F7] m-[0_0_24.5px_0] w-full h-[0px]"></div>
                <div class="m-[0_25px_19.5px_25px] inline-block self-start break-words font-['Inter'] font-medium text-[12px] text-[#6F7D93]">
                    Choisissez Type de Déclaration
                </div>
              
                <div class="m-[0_0_25px_0] flex flex-row justify-around self-start w-full box-sizing-border">
                    <div class="flex flex-row box-sizing-border items-center">
                        <input type="checkbox" id="nuisance" name="type[]" value="nuisance" onclick="updateSelectedTypes()" />
                        <label for="nuisance" class="ml-2 inline-block break-words font-['Inter'] text-[12px] text-[#6F7D93]">Nuisance</label>
                    </div>
                    <div class="flex flex-row box-sizing-border items-center">
                        <input type="checkbox" id="sinistre" name="type[]" value="sinistre" onclick="updateSelectedTypes()" />
                        <label for="sinistre" class="ml-2 inline-block break-words font-['Inter'] text-[12px] text-[#6F7D93]">Sinistre</label>
                    </div>
                </div>
                
                <input type="hidden" name="type" id="selectedType" />

                <div class="m-[0_25px_12.5px_25px] font-medium text-[12px] text-[#6F7D93]">
                    Entrez l’objet de votre déclaration
                </div>
                <div class="relative m-[0_25px_29px_25px]">
                    <input type="text" placeholder="Objet de votre déclaration" id="titre" name="titre"
                        class="rounded-[8px] border-[1px solid #9EAFCE] bg-[#F1F1F1] p-[12.5px_15px] w-full text-[12px] text-[#A2A2A2]" />
                </div>
                <div class="m-[0_25px_12.5px_25px] font-medium text-[12px] text-[#6F7D93]">
                    Entrez le lieu
                </div>
                <div class="relative m-[0_25px_29px_25px]">
                    <input type="text" placeholder="Exemple: Immeuble D" id="lieu" name="lieu"
                        class="rounded-[8px] border-[1px solid #9EAFCE] bg-[#F1F1F1] p-[12.5px_15px] w-full text-[12px] text-[#A2A2A2]" />
                </div>
               
                <div class="m-[0_25px_12.5px_25px] inline-block self-start break-words font-['Inter'] font-medium text-[12px] text-[#6F7D93]">
                    Descrivez de votre déclaration
                </div>
                <div class="relative m-[0_25px_29px_25px] items-center">
                    <textarea placeholder="Centenu de votre déclaration" id="description" name="description"
                        class="rounded-[8px] border-[1px_solid_#9EAFCE] bg-[#F1F1F1]  p-[12.5px_15px] inline-block break-words font-['Inter'] font-normal text-[12px] text-[#A2A2A2] box-sizing-border w-full"></textarea>
                    <div class="relative flex items-center justify-end">
                        <label for="file-input">
                            <img class="rotate-[45deg] cursor-pointer w-[15px]" src="../assets/vectors/vector_11_x2.svg" alt="Upload" />
                        </label>
                        <input type="file" id="file-input" name="image" class="hidden" />
                    </div>
                </div>
                <div class="bg-[#F7F7F7] m-[0_0_11px_0] w-[200px] h-[0px]"></div>

                <input type="hidden" value="{{ $residence }}" name="residence_id">

                <button type="submit" class="flex items-center justify-center px-3">
                    <div class="rounded-[60px] border border-[#9EAFCE] bg-[#3C4C7C] flex items-center justify-center p-[11.5px_0_11.5px_0] max-w-[300px] w-full">
                        <span class="break-words font-['Inter'] font-bold text-[14px] text-[#FFFFFF]">Envoyer</span>
                    </div>
                </button>
            </div>
        </form>
    </div>
    @endrole

    @role('superadmin|admin|manager principal|manger')
    <script>
        function updateSelectedTypes() {
            const selectedTypes = [];
            const checkboxes = document.querySelectorAll('input[name="type[]"]:checked');

            checkboxes.forEach((checkbox) => {
                selectedTypes.push(checkbox.value);
            });

            document.getElementById('selectedType').value = selectedTypes.join(','); // Join selected types with commas
        }
    </script>
    @endrole
</div>
