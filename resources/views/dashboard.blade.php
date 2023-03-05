<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My post') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <a href="/" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                </a>
            </div>
        </div>
    </div> --}}
    <div class="py-6">
        <div class="flex flex-wrap justify-center gap-4 px-6">
            @if ($posts->count())
                @foreach ($posts as $post)
                    @if ($post->user->is(auth()->user()))
                        <div x-data="{ opsi: false }"
                            class="lg:w-1/5 w-full md:w-1/4 bg-gray-800 rounded-xl overflow-x-hidden cursor-pointer shadow-lg hover:shadow-2xl hover:scale-105 transform transition-all duration-300 relative">
                            @if ($post->photo)
                                <div class="px-4  h-44  mx-auto w-full">
                                    <img class="rounded-xl w-full h-full object-contain"
                                        src="{{ asset('storage/' . $post->photo) }}" alt='' />
                                </div>
                            @endif
                            <div class="flex justify-between flex-wrap p-6">
                                <div class="flex items-center ">
                                    <h1 class="text-lg text-gray-300 font-bold">{{ $post->body }}</h1>
                                </div>
                                <div class="flex space-x-6 items-center">
                                    <a href="{{ route('posts.show', $post) }}"
                                        class="flex text-teal-600 space-x-2 items-center">
                                        <span>
                                            <i class=" fas fa-comments"></i>
                                        </span>
                                        <span class=" font-semibold">{{ $post->comments->count() }}</span>
                                    </a>

                                </div>
                            </div>

                            <div class="absolute top-1 right-2">
                                <div @click.away="opsi = false" @click="opsi = ! opsi" class="cursor-pointer">
                                    <i class=" text-gray-200 "
                                        x-bind:class="opsi ? 'fas fa-times ' : 'fas fa-ellipsis-v'">
                                    </i>
                                </div>
                                <div x-show="opsi" x-transition.duration.300ms
                                    class="absolute  top-5 p-2 bg-gray-300 shadow-lg rounded-md z-50 right-3">
                                    <div class="flex flex-col">

                                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" role="button" class="text-white"><i
                                                    class="fas fa-trash text-red-600"></i></button>
                                        </form>
                                        <a href="{{ route('posts.edit', $post) }}">
                                            <i class="text-blue-600 fas fa-edit"></i>
                                        </a>
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

</x-app-layout>

{{-- <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">
                                <i class="text-red-600 fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('posts.edit', $post) }}" class="text-white mt-2">Edit</a> --}}
