@extends('layouts.main')

@section('content')
    <div class="lightbox" x-data="{ lightboxOpen: false, imgSrc: '' }" x-show="lightboxOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90" @lightbox.window="lightboxOpen = true; imgSrc = $event.detail;">
        <div class="lightbox-container">
            <img :src="imgSrc" @click.away="lightboxOpen = false" class="lg:max-w-4xl cursor-zoom-in">
        </div>
    </div>
    {{--  --}}
    <div class="mt-8">
        <nav class="flex bg-black text-gray-500 border-b py-3  max-w-[12rem] border-teal-500/50  " aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/"
                        class="text-sm text-gray-700 hover:text-gray-900 inline-flex items-center dark:text-gray-400 dark:hover:text-white">
                        <i class="mr-2 fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="text-gray-600 fas fa-chevron-right"></i>
                        <div
                            class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2 text-sm font-medium dark:text-gray-400 dark:hover:text-white">
                            detail-post</div>
                    </div>
                </li>
                {{-- <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-400 ml-1 md:ml-2 text-sm font-medium dark:text-gray-500">Theme</span>
                    </div>
                </li> --}}
            </ol>
        </nav>
    </div>
    <article class="my-12">
        <div class="w-full  text-white   p-3">
            <div class="flex flex-col w-full">
                <small class="opacity-90 mb-4 text-gray-400">{{ $post->created_at->diffForhumans() }}</small>
                <a href="{{ route('profile.show', $post->user->name) }}" class="text-lg mb-3">{{ $post->user->name }}</a>
                <div class="h-16 w-16 rounded-full">
                    @if ($post->user->avatar == 'default.jpg')
                        <img src="/img/{{ $post->user->avatar }}" class="w-full h-full rounded-full object-cover"
                            alt="">
                    @else
                        <img src="{{ asset('storage/' . $post->user->avatar) }}"
                            class="w-full h-full rounded-full object-cover" alt="">
                    @endif
                </div>
            </div>
            @if ($post->photo)
                <div class="mt-7 cursor-pointer">
                    {{-- <img src="/storage/{{ $post->photo }}" alt=""> --}}
                    <img src="{{ asset('storage/' . $post->photo) }}"
                        @click="$dispatch('lightbox', '{{ asset('storage/' . $post->photo) }}')" />
                </div>
            @endif
            <div class="mt-7">
                <p>
                    {!! $post->body !!}
                </p>
            </div>
        </div>
        <div class="border-b mt-3 border-teal-500 opacity-50 ">
        </div>
        <div class="max-w-[18rem]  mt-12 mb-6">
            <h3 class="text-white font-semibold">{{ $post->comments->count() }} comments</h3>
        </div>
        @if ($post->comments->count() > 0)
            @include('components.comments.comment')
        @endif
        <div class="max-w-[18rem] mb-6 border rounded-md border-teal-500/50">
            <form class="p-2 py-4" action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea name="value" id="value"
                    class="w-full placeholder:text-sm text-sm border-teal-500/50 focus:border-teal-500/50 text-gray-300 focus:ring-1 focus:ring-teal-500/30 bg-black rounded-md"
                    placeholder="comments something....">{{ old('value') }}</textarea>
                @error('value')
                    <p class="mb-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
                <button type="submit"
                    class="px-3 p-[0.35rem] rounded-md bg-teal-500/50 text-sm mt-2 text-white">Comment</button>
            </form>
        </div>
    </article>
    <div class="max-w-[18rem]">
        <a href="/" class="flex items-center gap-1  ">
            <i class="fas fa-long-arrow-alt-left text-2xl text-teal-600"></i>
            <span class="text-teal-600 text-lg">back</span>
        </a>
    </div>
@endsection
