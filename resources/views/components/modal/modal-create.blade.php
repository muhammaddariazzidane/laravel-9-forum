{{-- x-show="modelOpen"  --}}
<div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
        <div x-cloak @click="modelOpen = false" x-show="modelOpen"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
        {{-- x-show="modelOpen" --}}
        <div x-show="modelOpen" x-cloak x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
            <div class="flex items-center justify-between space-x-4">
                <h1 class="text-xl font-medium text-gray-100 ">Create a post</h1>


            </div>


            <form class="mt-5" method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="body" class="block text-sm text-gray-700 capitalize dark:text-gray-300">body</label>

                    <textarea name="body" id="body" rows="3"
                        class="w-full mt-3 py-2 px-3 placeholder:text-sm text-sm border-teal-500/50 focus:border-teal-500/50 text-gray-300 focus:ring-1 focus:ring-teal-500/30 bg-gray-900 rounded-md"
                        placeholder="posts something....">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="ml-1 text-sm text-red-600 dark:text-red-500">
                            {{ $message }}

                        </p>
                    @enderror
                </div>
                <div class="mt-3">
                    <div class="flex flex-col gap-y-4  ">

                        <div class="shrink-0 h-20 w-36 hidden" id="wrapPrevImg">
                            <img class="img-preview mr-3 w-full h-full object-contain" src="" alt="" />
                        </div>
                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" onchange="handlePrev()" name="photo" id="input-img"
                                class="block w-full text-sm text-gray-300
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-teal-700
                        hover:file:bg-violet-100 " />
                            @error('photo')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-teal-500 rounded-md dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:bg-teal-700 hover:bg-teal-600 focus:outline-none focus:bg-teal-500 focus:ring focus:ring-teal-300 focus:ring-opacity-50">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
