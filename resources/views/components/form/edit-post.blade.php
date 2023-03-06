@extends('layouts.main')

@section('content')
    <div class="max-w-2xl p-6 rounded-lg mx-auto mt-8 bg-gray-800">

        <div class="flex items-center justify-between space-x-4">
            <h1 class="text-xl font-medium text-gray-100 ">Edit post</h1>


        </div>
        <form class="mt-5" method="post" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <input type="hidden" name="old_photo" value="{{ $post->photo }}">
            <div>
                <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-300">body</label>
                <input placeholder="lorem ipsum dolor" name="body" type="text " value="{{ old('body', $post->body) }}"
                    class="block w-full px-3 py-2 mt-2 text-gray-300 focus:placeholder:opacity-80 bg-gray-900 border border-teal-200 rounded-md focus:border-teal-400 focus:outline-none focus:ring focus:ring-teal-300 focus:ring-opacity-40">
                @error('body')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-6">
                <div class="flex gap-y-4 flex-col">
                    @if ($post->photo)
                        <div class="shrink-0 h-20 w-36" id="wrapPrevImg">
                            <img class="img-preview mr-3  w-full h-full object-contain"
                                src="{{ asset('storage/' . $post->photo) }}" alt="" />
                        </div>
                    @endif
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
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
