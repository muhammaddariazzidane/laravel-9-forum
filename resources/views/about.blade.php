@extends('layouts.main')

@section('content')
    {{-- <div class="space-y-2 pt-6 pb-8 md:space-y-5"> --}}
    <div class="mt-8 flex justify-center flex-col  items-center">
        <h1
            class="text-3xl font-extrabold leading-9 tracking-tight text-gray-900 dark:text-gray-100 sm:text-4xl sm:leading-10 md:text-4xl md:leading-16">
            About me</h1>

        <div class="w-[40%] h-full mt-7">
            <img src="/img/default.jpg" class="w-full rounded-full h-full object-contain" alt="">
        </div>
        <h1 class="text-white mt-5 md:text-2xl text-base font-semibold">Muhammad Dariaz Zidane</h1>
        <h1 class="text-gray-300 italic md:text-xl mt-1 ">jodhykotambunan@gmail.com</h1>
    </div>
    {{-- </div> --}}
@endsection
