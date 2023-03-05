@extends('layouts.main')


@section('content')
    {{-- <div class="mt-12 ">
        @include('components.form.search')
        @auth

            <div class="mt-6" x-data="{ modelOpen: false }">
                @include('components.button.create-btn')
                @include('components.modal.modal-create')
            </div>
        @endauth
    </div> --}}
    <div class="mt-8">
        <nav class="flex bg-black text-gray-500 border-b py-3  max-w-[18rem] border-teal-500/50  " aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('profile.show', $posts[0]->user->name) }}"
                        class="text-xl text-gray-300 hover:text-gray-600 inline-flex items-center dark:text-gray-200 dark:hover:text-white">
                        <div class="h-10 w-10 ">
                            @if ($posts[0]->user->avatar == 'default.jpg')
                                <img src="{{ asset('/img/default.jpg') }}" alt=""
                                    class="w-full rounded-full  h-full object-cover">
                            @else
                                @if (!$posts[0]->user->auth_type)
                                    <img src="{{ asset('storage/' . $posts[0]->user->avatar) }}" alt=""
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="{{ $posts[0]->user->avatar }}" alt="/"
                                        class="w-full h-full object-cover">
                                @endif
                            @endif
                        </div>
                        <span class="ml-3">
                            {{ $posts[0]->user->name }}
                        </span>
                    </a>
                </li>
                {{-- <li>
                    <div class="flex items-center">
                        <i class="text-gray-600 fas fa-chevron-right"></i>
                        <a href="#"
                            class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2 text-sm font-medium dark:text-gray-400 dark:hover:text-white">{{ $posts[0]->user->name }}</a>
                    </div>
                </li> --}}

            </ol>
        </nav>
    </div>
    <ul class="mt-4">

        @if ($posts->count())
            @foreach ($posts as $post)
                <li class="py-12 border-b border-teal-900">
                    <article>
                        <div class="space-y-2 xl:grid xl:grid-cols-4 xl:items-baseline xl:space-y-0">
                            <div class="text-base font-medium leading-6 text-gray-400 dark:text-gray-400">
                                <div class="flex flex-col gap-y-2">
                                    <span>{{ $post->created_at->diffForhumans() }}</span>
                                    @if ($post->photo)
                                        <a href="{{ route('posts.show', $post) }}"
                                            class=" hidden h-20 lg:block w-32 rounded-lg">
                                            <img src="{{ asset('storage/' . $post->photo) }}"
                                                class="object-contain rounded-lg w-full h-full" alt="/" />
                                        </a>
                                    @endif

                                </div>

                            </div>
                            <div class="space-y-5 xl:col-span-3">
                                <div class="space-y-4">
                                    <div>
                                        <a href="{{ route('profile.show', $post->user->name) }}"
                                            class="text-2xl font-bold leading-8 truncate dark:text-white tracking-tight">
                                            {{ $post->user->name }}</a>
                                    </div>
                                    <div class="prose max-w-none text-gray-400 dark:text-gray-400">
                                        {{ $post->body }}
                                    </div>
                                </div>
                                <div class="text-base font-medium leading-6">
                                    <a href="{{ route('posts.show', $post) }}"
                                        class="text-teal-500 transition-all duration-300 hover:text-teal-600 dark:hover:text-teal-400">
                                        <i class="fas fa-comments"></i> {{ $post->comments->count() }}</a>
                                </div>

                            </div>
                        </div>
                    </article>
                </li>
            @endforeach
        @else
            <h1 class="text font-semibold text-2xl tracking-tight text-gray-900 dark:text-gray-100">
                You don't have a post</h1>
        @endif
    </ul>
@endsection
