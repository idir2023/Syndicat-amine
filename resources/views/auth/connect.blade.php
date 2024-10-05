<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Left Section -->
        <div class="w-2/3 flex flex-col md:flex-row bg-[#7d8fae] p-10 space-y-8 md:space-y-0 md:space-x-8">
            <!-- Left Section -->
            <div class="flex-1 flex flex-col items-center text-center md:text-left space-y-6 mt-9 mr-5">
                <h2 class="text-4xl font-bold text-white">Synditchat</h2>
                <p
                    class="text-lg text-white text-center py-12 font-['Fredoka_One','Roboto_Condensed'] font-normal text-[30px]">
                    Votre solution complète pour la gestion de copropriété, assurant conformité, transparence et
                    communication fluide
                </p>
                <div class="w-80 h-auto">
                    <img src="{{ asset('assets/images/neighbours_on_balconies_or_windows_during_coronavirus_rafiki_1.png') }}"
                        alt="Illustration">
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex-1 flex flex-col items-center text-center md:text-left space-y-6">
                <div class="w-80 h-auto">
                    <img src="{{ asset('assets/images/build_your_home_amico_11.png') }}" alt="Illustration">
                </div>
                <p
                    class="text-lg text-white text-center py-12 font-['Fredoka_One','Roboto_Condensed'] font-normal text-[30px]">
                    Si vous n'avez pas de compte, remplissez dès maintenant le formulaire d'inscription et simplifiez la
                    gestion de votre copropriété
                </p>
                <button class="bg-[#F7F7F7] text-[#7d8fae] py-3 px-6 rounded-full font-bold text-xl hover:bg-[#cbc9c9]">
                    <a href="{{ route('formRegister') }}">Remplir le formulaire</a>
                </button>
            </div>
        </div>



        <!-- Right Section -->
        <div class="w-full md:w-1/3 bg-[#F7F7F7] p-8 flex flex-col justify-center items-center">
            <h2
                class="text-4xl font-bold mb-8 
                font-['Fredoka_One','Roboto_Condensed'] text-[48px] text-[#3C4C7C]">
                Se Connecter
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="space-y-4 w-full max-w-md" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label
                        class="block mb-1
                    font-['Inter'] font-medium text-[16px] text-[#6F7D93]">Entrez
                        Votre E-mail</label>
                    <div class="flex items-center border rounded-[80px]">
                        <x-text-input id="email"
                            class="focus:ring-indigo-700"
                            type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" 
                            placeholder="Exemple@synditchat.com"/>
                            <i class="fa-solid fa-envelope ml-1 pr-2 h-4 w-auto"></i>
                            
                    </div>
                    <!-- Email Error -->
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="h-[3%]"></div>
                <div>
                    <label
                        class="block mb-1
                    font-['Inter'] font-medium text-[16px] text-[#6F7D93]">Entrez
                        Votre Mot de passe</label>
                    <div class="flex items-center border rounded-[80px]">
                        <x-text-input id="password"
                            class="focus:ring-indigo-700"
                            type="password" name="password" required autocomplete="current-password" placeholder="Mot de passe"/>
                            <i class="fa-solid fa-lock ml-1 pr-2 h-4 w-auto"></i>
                    </div>
                    <!-- Password Error -->
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="h-[0.5%]"></div>
                <div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <input id="remember_me" type="checkbox"
                            class="h-6 w-6 rounded-[25px] text-[#3C4C7C] font-semibold focus:ring-blue-500 border-[#3C4C7C]" name="remember">
                        <label for="remember_me" class="text-gray-600">Restez connecté</label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="break-words font-['Inter'] font-medium text-[16px] text-[#3C4C7C]">Mot de passe oublié ?</a>
                    @endif
                </div>
                <div class="mb-22 p-20">
                    <button type="submit"
                        class="w-full bg-[#3C4C7C] hover:bg-[#3e569b] text-white
                                py-3 px-6 rounded-full font-bold text-xl">Connexion</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
