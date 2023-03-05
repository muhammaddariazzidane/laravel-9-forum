@extends('layouts.main')

@section('content')
    <div class="lightbox z-[9999]" x-data="{ lightboxOpen: false, imgSrc: '' }" x-show="lightboxOpen"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
        @lightbox.window="lightboxOpen = true; imgSrc = $event.detail;">
        <div class="lightbox-container">
            <img :src="imgSrc" @click.away="lightboxOpen = false" class="lg:max-w-4xl cursor-zoom-in">
        </div>
    </div>

    <div class="flex mt-12 flex-col justify-center items-center ">
        <div
            class="relative flex flex-col items-center rounded-[20px] max-w-[350px] w-full mx-auto p-4 bg-gray-800 bg-clip-border shadow-3xl shadow-shadow-500  dark:text-white ">
            <div class="relative flex h-32 w-full justify-center rounded-xl bg-cover">
                <div
                    class="absolute cursor-pointer top-2 flex h-[87px] w-[87px] items-center justify-center rounded-full border-[4px] border-teal-500 ">
                    @if ($user->avatar == 'default.jpg')
                        <img class="h-full w-full rounded-full " src='{{ asset('/img/default.jpg') }}' alt=""
                            @click="$dispatch('lightbox', '{{ asset('/img/default.jpg') }}')" />
                        {{-- <img class="rounded-full w-full h-full object-cover"
                    src="{{ asset('/img/default.jpg') }}"
                    alt=""> --}}
                    @else
                        @if (!$user->auth_type)
                            <img class="h-full w-full rounded-full" src='{{ asset('storage/' . $user->avatar) }}'
                                alt="" @click="$dispatch('lightbox', '{{ asset('storage/' . $post->photo) }}')" />
                        @else
                            <img class="h-full w-full rounded-full" src='{{ $user->avatar }}' alt=""
                                @click="$dispatch('lightbox', '{{ $user->avatar }}')" />
                        @endif
                    @endif
                </div>
            </div>
            <div class="flex flex-col items-center">
                <h4 class="text-xl font-bold text-navy-700 dark:text-white">
                    {{ $user->name }}
                </h4>
                <p class="text-base font-normal text-gray-400">{{ $user->email }}</p>
            </div>
            <div class="mt-6 mb-3 flex justify-center gap-14 md:!gap-14">
                <a href="{{ route('user.posts', $user->name) }}" class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-navy-700 dark:text-white">{{ $user->posts->count() }}</p>
                    <p class="text-sm font-normal text-gray-400">Posts</p>

                </a>
                {{-- <div class="flex flex-col items-center justify-center">
                    <img src="{{ asset('storage/' . $user->posts[0]->photo) }}"
                        class="w-10 h-10 />


                    <p class="text-sm font-normal text-gray-600">Followers</p>
                </div> --}}
                <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-navy-700 dark:text-white">
                        {{ $user->comments->count() }}
                    </p>
                    <p class="text-sm font-normal text-gray-600">Comments</p>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-navy-700 dark:text-white">
                        {{ $user->replies->count() }}
                    </p>
                    <p class="text-sm font-normal text-gray-600">Replies</p>
                </div>
            </div>
        </div>

    </div>
@endsection
