<form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-[330px]">
    @csrf

    <div class="shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] rounded-[20px] bg-[#FFFFFF] relative m-[0_0_155px_0] flex flex-col p-[16.5px_0_18px_0] box-border">
        <div class="m-[0_25px_26.5px_25px] inline-block self-start break-words font-['Inter'] font-semibold text-[14px] text-[#3C4C7C]">
            Ajouter Un Document
        </div>
          {{-- display the messages and errors  --}}
          <x-error.message ></x-error.message>

        <!-- Divider -->
        <div class="bg-[#F7F7F7] m-[0_0_24.5px_0]  h-[0px]"></div>

        <!-- Document Type Selection -->
        <div class="m-[0_25px_12.5px_25px] inline-block self-start break-words font-['Inter'] font-medium text-[12px] text-[#6F7D93]">
            Sélectionnez Type du document
        </div>
        <div class="rounded-[8px] border-[1px_solid_#9EAFCE] bg-[#F1F1F1] relative m-[0_25px_19.5px_25px] p-[12.5px_15px_9px_15px] ">
            <select id="type" name="type" class="m-[0_7.5px_3.5px_0] inline-block  break-words font-['Inter'] font-normal text-[12px] text-[#A2A2A2]">
                <option value="Compte rendu">Compte rendu</option>
                <option value="Facture et devis">Facture et devis</option>
                <option value="Autres">Autres</option>
            </select>
        </div>

        <!-- Title Input -->
        <div class="m-[0_25px_12.5px_25px] inline-block self-start break-words font-['Inter'] font-medium text-[12px] text-[#6F7D93]">
            Entrez le titre
        </div>
        <input type="text" name="titre" class="rounded-[8px] border-[1px_solid_#9EAFCE] bg-[#F1F1F1] relative m-[0_25px_19.5px_25px] p-[12.5px_15px_12.5px_15px] box-border text-[12px] text-[#A2A2A2] break-words font-['Inter'] font-normal" placeholder="Titre du document">

        <!-- File Input -->
        <div class="m-[0_25px_12.5px_25px] inline-block self-start break-words font-['Inter'] font-medium text-[12px] text-[#6F7D93]">
            Importez le document
        </div>
        <div class="rounded-[8px] border-[1px_solid_#9EAFCE] bg-[#F1F1F1] relative m-[0_25px_19.5px_25px] flex flex-col items-center p-[33px_0_30.5px_0]  box-border">
            <label for="file-input" class="cursor-pointer flex flex-col items-center">
                <img class="rotate-[45deg] m-[0_4px_18.5px_0] w-[25px] h-[50px]" src="../assets/vectors/vector_3_x2.svg" />
                <span class="break-words font-['Inter'] font-normal text-[12px] text-[#A2A2A2]">Importer votre fichier</span>
            </label>
            <input type="file" id="file-input" name="fichier" class="hidden" />
        </div>
        <!-- Comment Section -->
        <div class="m-[0_25px_12.5px_25px] inline-block self-start break-words font-['Inter'] font-medium text-[12px] text-[#6F7D93]">
            Ajouter un commentaire
        </div>
        <textarea name="commentaire" class="rounded-[8px] border-[1px_solid_#9EAFCE] bg-[#F1F1F1] relative m-[0_25px_24px_25px] p-[12.5px_15px_52.5px_15px]  box-border break-words font-['Inter'] font-normal text-[12px] text-[#A2A2A2]" placeholder="Ajoutez un commentaire"></textarea>

        <!-- Hidden Input for Resident ID -->
        <input type="hidden" name="residence_id" value="{{ $residence }}">

        <!-- Divider -->
        <div class="bg-[#F7F7F7] m-[0_0_11px_0] w-[380px] h-[0px]"></div>

        <!-- Submit Button -->
        <button type="submit">
            <div class="rounded-[60px] border-[1px_solid_#9EAFCE] bg-[#3C4C7C] relative m-[0_25px_0_25px] flex p-[11.5px_0_11.5px_0]  box-border justify-center">
                <span class="break-words font-['Inter'] font-bold text-[14px] text-[#FFFFFF]">Envoyer</span>
            </div>
        </button>
    </div>
</form>
