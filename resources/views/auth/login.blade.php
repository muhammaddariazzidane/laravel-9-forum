<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="mb-5">
        <h1 class="text-center text-2xl font-semibold text-white">Login</h1>
    </div>
    <h5 class="text-center text-sm text-gray-700 dark:text-gray-300">Login with social media account</h5>

    <div class="text-center flex justify-center gap-x-2 my-7 font-semibold text-white">
        <div>
            <a href="{{ route('github.login') }}"
                class="inline-block bg-slate-700 px-4 rounded-md py-[0.45rem] shadow-sm transition-all duration-300 hover:shadow-lg mx-auto">
                <div class="flex items-center gap-x-2">
                    <i class="fab scale-125 fa-github"></i>
                    {{-- <i data-feather="github" class="scale-90"></i> --}}
                    <h1>GitHub</h1>
                </div>
            </a>
        </div>
        <div>
            <a href="{{ route('google.login') }}"
                class="inline-block bg-slate-200 text-black px-4 rounded-md py-[0.45rem] shadow-sm transition-all duration-300 hover:shadow-lg mx-auto">
                <div class="flex items-center gap-x-2">

                    <i
                        class="fab scale-125 fa-google bg-gradient-to-b from-red-700 via-yellow-600 to-blue-700 bg-clip-text text-transparent"></i>
                    {{-- <i data-feather="gitlab" class=" scale-90"></i> --}}
                    <h1>Google</h1>
                </div>
            </a>
        </div>
        {{-- <div>
            <a onclick="alert('comming soon')"
                class="inline-block cursor-pointer bg-slate-700 px-4 rounded-md py-[0.35rem] shadow-sm transition-all duration-300 hover:shadow-lg mx-auto">
                <div class="flex items-center gap-x-2">
                    <i data-feather="gitlab" class="scale-90 text-orange-500"></i>
                    <h1>GitLab</h1>
                </div>
            </a>
        </div> --}}
    </div>
    <div class="text-center text-sm my-8 text-gray-700 dark:text-gray-300 flex items-center justify-around">
        <div class="w-full h-[1px] bg-gray-500"> </div>
        <span class="mx-2">or</span>
        <div class="w-full h-[1px] bg-gray-500"> </div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full pr-12" type="password"
                x-bind:type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <div class="absolute cursor-pointer inset-y-0 right-0 top-6 pr-3 flex items-center text-sm leading-5">
                <i class="fas fa-eye text-white text-xl":class="{ 'block': !show, 'hidden': show }"
                    @click="show = ! show"></i>
                <i class="fas fa-eye-slash text-white text-xl":class="{ 'hidden': !show, 'block': show }"
                    @click="show = ! show"></i>
            </div>
        </div>



        <div class="flex items-center justify-end mt-9">
            @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('register') }}">
                    {{ __('Dont have account?') }}
                </a>
            @endif

            <x-primary-button class="ml-3 mb-4">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
