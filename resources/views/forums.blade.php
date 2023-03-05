<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum-ngebull</title>

    @notifyCss
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        #menu-toggle:checked+#menu {
            display: block;
        }
    </style>
</head>

<body class="scrollbar-hide bg-black">
    <div>
        @include('components.header.navbar')
        <div class="flex h-screen  antialiased text-gray-800">
            <div class="flex flex-row h-full lg:max-w-4xl w-full mx-auto overflow-x-hidden">

                <div class="flex flex-col flex-auto h-full p-6">
                    <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-800 h-full p-4">
                        <div class="flex flex-col h-full  overflow-x-auto mb-4">
                            <div class="flex flex-col  h-full">
                                <div class="grid grid-cols-12 gap-y-2">
                                    @if ($chats->count())
                                        @foreach ($chats as $chat)
                                            @if ($chat->user->is(auth()->user()))
                                                {{-- yang ngirim di bawah --}}
                                                <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                                    {{-- image chat --}}
                                                    @if ($chat->image)
                                                        <div class="flex justify-start mr-16 flex-row-reverse mb-1 ">
                                                            <div class="w-[50%] h-[50%] ">
                                                                <img src="{{ asset('storage/' . $chat->image) }}"
                                                                    class="w-full h-full shadow-md shadow-gray-900 object-contain rounded-md"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    @endif
                                                    {{-- image chat --}}
                                                    <div class="flex items-center justify-start flex-row-reverse">
                                                        <div
                                                            class="flex items-center justify-center h-10 w-10 rounded-full  flex-shrink-0">
                                                            @if ($chat->user->avatar == 'default.jpg')
                                                                <img class="rounded-full w-full h-full object-cover"
                                                                    src="{{ asset('/img/default.jpg') }}"
                                                                    alt="">
                                                            @else
                                                                @if (!$chat->user->auth_type)
                                                                    <img class="rounded-full w-full h-full object-cover"
                                                                        src="{{ asset('storage/' . $chat->user->avatar) }}"
                                                                        alt="">
                                                                @else
                                                                    <img class="rounded-full w-full h-full object-cover"
                                                                        src="{{ $chat->user->avatar }}" alt="">
                                                                @endif
                                                            @endif
                                                        </div>

                                                        <div
                                                            class="relative mr-3 text-sm bg-emerald-700 text-gray-100 py-2 px-4 shadow rounded-xl">

                                                            <div>{{ $chat->message }}</div>
                                                            <div
                                                                class="absolute -bottom-5 text-gray-300   italic right-1">
                                                                <small class="truncate text-[0.5rem]">
                                                                    {{ $chat->created_at->diffForhumans() }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                                    {{-- image chat --}}
                                                    @if ($chat->image)
                                                        <div class="flex justify-start ml-16 flex-row mb-1 ">
                                                            <div class="w-[50%] h-[50%] ">
                                                                <img src="{{ asset('storage/' . $chat->image) }}"
                                                                    class="w-full h-full shadow-md shadow-gray-900 object-contain rounded-md"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    @endif
                                                    {{-- image chat --}}
                                                    <div class="flex flex-row items-center">
                                                        <div
                                                            class="flex items-center justify-center h-10 w-10 rounded-full  flex-shrink-0">
                                                            @if ($chat->user->avatar == 'default.jpg')
                                                                <img class="rounded-full w-full h-full object-cover"
                                                                    src="{{ asset('/img/default.jpg') }}"
                                                                    alt="">
                                                            @else
                                                                @if (!$chat->user->auth_type)
                                                                    <img class="rounded-full w-full h-full object-cover"
                                                                        src="{{ asset('storage/' . $chat->user->avatar) }}"
                                                                        alt="">
                                                                @else
                                                                    <img class="rounded-full w-full h-full object-cover"
                                                                        src="{{ $chat->user->avatar }}" alt="">
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div
                                                            class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                            <div>{{ $chat->message }}</div>
                                                            <div
                                                                class="absolute -bottom-5 text-gray-300   italic left-1">
                                                                <small class="truncate text-[0.5rem]">
                                                                    {{ $chat->created_at->diffForhumans() }}</small>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                    @endif

                                </div>
                            </div>
                        </div>
                        <form method="post" action="{{ route('chats.store') }}" enctype="multipart/form-data"
                            class="flex flex-row items-center h-16 rounded-xl bg-gray-800 overflow-auto w-full px-2">
                            @csrf
                            <div>
                                <label for="image">
                                    @error('image')
                                        <p class="mb-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                    <input type="file" name="image" class="hidden" id="image"
                                        onchange="handlePrev()">
                                    <div class="flex items-center gap-x-2">

                                        <p class="text-white text-xs hidden" id="textUpload"></p>
                                        <i class="fas fa-paperclip cursor-pointer text-gray-200 text-lg"
                                            id="iconUpload"></i>
                                    </div>
                                </label>
                                {{-- <button class="flex items-center justify-center text-gray-400 hover:text-gray-500"> --}}
                                {{-- </button> --}}
                            </div>
                            <div class="flex-grow ml-4">
                                <div class="relative w-full">
                                    @error('message')
                                        <p class="mb-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                    <input aria-label="message" type="text" name="message"
                                        placeholder="chat somethings..." autofocus value="{{ old('message') }}"
                                        class="flex w-full border rounded-xl focus:outline-none bg-gray-900 text-gray-300 focus:ring-teal-500  border-teal-700 focus:border-teal-500 pl-4 h-10" />
                                </div>
                            </div>
                            <div class="ml-4">
                                <button type="submit"
                                    class="flex items-center justify-center bg-teal-700 hover:bg-teal-600 rounded-xl text-white px-3 py-2 flex-shrink-0">
                                    <span class="lg:block hidden">Send</span>
                                    <span class="lg:ml-2 ml-0">
                                        <i class="fas fa-paper-plane"></i>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    {{-- @include('components.footer') --}}
    {{-- @include('components.button.to-top') --}}
    <x:notify-messages />
    @notifyJs
    <script>
        function handlePrev() {
            // const imgPreview = document.querySelector('.img-preview')
            const inputImg = document.querySelector('#image')
            // const icon = document.querySelector('#iconUpload')
            const textUp = document.querySelector('#textUpload')
            // const wrapPrevImg = document.querySelector('#wrapPrevImg')

            textUp.textContent = inputImg.files[0].name

            const fileSampul = new FileReader()

            fileSampul.readAsDataURL(inputImg.files[0])

            fileSampul.onload = function() {
                // icon.classList.add('hidden')
                textUp.classList.remove('hidden')
                // alert('oiii')
                // wrapPrevImg.classList.remove('hidden')
                // imgPreview.src = e.target.result
            }
        }
    </script>
</body>

</html>
