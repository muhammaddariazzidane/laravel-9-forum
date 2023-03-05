<div class='max-w-md '>
    <form class="relative flex items-center w-full h-12 rounded-xl focus-within:shadow-lg overflow-hidden">

        <button type="submit" role="button" id="buttonTitle" title="Title"
            class="grid place-items-center h-full focus:border-none focus:outline-none active:opacity-80 transition-all duration-300 bg-slate-900 focus:ring-0 w-12 text-gray-300">
            <i class="fas fa-search text-xl"></i>
        </button>
        <input
            class="peer h-full w-full outline-none text-sm text-gray-200 border-none focus:outline-none focus:ring-0 focus:border-none focus:placeholder:opacity-75 bg-slate-900  pr-2"
            type="text" id="search" name="search" value="{{ request('search') }}"
            placeholder="Search something.." />
    </form>
</div>
