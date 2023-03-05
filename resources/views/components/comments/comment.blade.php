@foreach ($post->comments->load('replies') as $comment)
    <div x-data="{ opsi: false, reply: false }">
        <div class="max-w-[18rem] mb-6 border rounded-md border-teal-500/50 relative">
            <div class="px-4 py-3 flex items-center gap-2  flex-wrap">
                <div class="text-white w-12 h-10">
                    <img src="{{ $comment->user->avatar }}" class="w-full h-full object-cover rounded-full" alt="">
                </div>
                <div class="text-white">
                    <h2 class="text-sm truncate">{{ $comment->user->name }}</h2>
                </div>
                <div class="text-white">
                    <small class="text-gray-300 text-xs">{{ $comment->created_at->diffForhumans() }}</small>
                </div>
            </div>
            <div class="px-4 pt-2 pb-4 text-sm text-white mt-0">
                <p>{!! $comment->value !!}</p>
            </div>
            <div class="px-4 pb-4 flex justify-end cursor-pointer" @click="reply = ! reply">
                <h5 class="text-gray-300 text-xs">{{ $comment->replies->count() }} replies</h5>
            </div>
            @if ($comment->user->is(auth()->user()))
                <div class="absolute right-2 top-2">
                    <div @click.away="opsi = false" @click="opsi = ! opsi" class="cursor-pointer">
                        <i class=" text-white " x-bind:class="opsi ? 'fas fa-times ' : 'fas fa-ellipsis-v'"> </i>
                    </div>
                </div>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" x-show="opsi"
                    x-transition.duration.300ms
                    class="absolute top-7 p-2 bg-gray-200 shadow-lg rounded-md z-10 right-5">
                    @csrf
                    @method('delete')
                    <button type="submit"><i class="fas fa-trash text-red-600"></i></button>
                </form>
            @endif
            @if ($comment->replies->count() > 0)
                <div x-show="reply" class="text-teal-700 max-w-[18rem] mb-4 border-t border-teal-500/50">
                    @foreach ($comment->replies as $reply)
                        <div class="px-6 py-2 flex items-center gap-2 overflow-hidden">
                            <div class="w-10 h-8">
                                <img src="{{ $reply->user->avatar }}" class="w-full h-full object-cover rounded-full"
                                    alt="">
                            </div>
                            <div class="text-white">
                                <h2 class="text-sm truncate">{{ $reply->user->name }}</h2>
                            </div>
                            <div class="text-white">
                                <small class="text-gray-300 text-xs">{{ $reply->created_at->diffForhumans() }}</small>
                            </div>
                        </div>
                        <div class="pl-[3.5rem] pr-5 text-gray-300 text-sm">
                            {{ $reply->isi }}
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

        {{-- form reply --}}
        <div @click.away="reply = false" class="max-w-[18rem] -mt-6   rounded-md" x-show="reply"
            x-transition.duration.300ms>
            <form class=" py-4" action="{{ route('replies.store') }}" method="POST">
                @csrf
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <input name="isi" id="isi" type="text"
                    class="w-full placeholder:text-sm text-sm border-teal-500/50 focus:border-teal-500/50 text-gray-300 focus:ring-1 focus:ring-teal-500/30 bg-black rounded-md"
                    placeholder="reply something...." value="{{ old('isi') }}" />
                @error('isi')
                    <p class="mb-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex justify-end">

                    <button type="submit"
                        class="px-3 p-[0.35rem] rounded-md bg-teal-500/50 text-sm mt-2 text-white">Balas</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
