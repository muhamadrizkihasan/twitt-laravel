<x-app-layout>
    <div class="card my-4 bg-white">
        <div class="card-body">
            <div class="text-black">
                <h2 class="text-xl font-bold">{{ $tweet->user->name }}</h2>
                <span class="text-xs">{{ $tweet->created_at->diffForHumans() }}</span>
                <p>{{ $tweet->content }}</p>
            </div>
            
            <div class="text-end text-xs card-actions justify-end">
                <a href="{{ route('tweets.edit', $tweet->id) }}" class="link link-hover btn btn-success btn-sm text-white">Edit</a>
                <form action="{{ route('tweets.destroy', $tweet->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-error btn-sm text-white">
                </form>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('comments.store', $tweet) }}" class="form-control" method="POST">
                @csrf
                <textarea class="textarea textarea-bordered bg-white" name="message" placeholder="Tinggalkan komentar..." rows="3"></textarea>
                <div class="card-actions pt-2">
                    <input type="submit" class="btn btn-primary text-white" value="Komentar">
                </div>
            </form>
        </div>
    </div>

            {{-- @if ($tweet->comments) --}}
            <div class="card bg-base-100 p-2">
            <div class="card-title bg-white p-2 mt-2">Komentar</div><hr>
                @foreach ($tweet->comments as $comment)
                    <div class="card-body bg-white text-black">
                        {{-- Konten komentar --}}
                        <p class="text-black">{{ $comment->message }}</p>
                    </div>

                    <div class="card-actions p-2 bg-white">
                        <a href="{{ route('comments.edit', [$tweet, $comment]) }}" class="link link-hover btn btn-sm btn-success text-white">Edit</a>
                        <form action="{{ route('comments.destroy', [$tweet, $comment]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-error btn-sm text-white">
                        </form>
                    </div>
                    <hr>
                @endforeach
            </div>
            {{-- @else
                <p>Tidak ada komentar.</p>
            @endif --}}
</x-app-layout>