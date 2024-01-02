<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 mb-2">
            <form action="{{ route('tweets.store') }}" class="form-control" method="POST">
                @csrf
                <textarea name="content" id="" cols="30" rows="3" class="textarea textarea-bordered mb-2 bg-white" placeholder="Tuliskan Sesuatu..."></textarea>
                @error('content')
                    <span class="text-error">{{ $message }}</span>
                @enderror
                <input type="submit" class="btn btn-primary text-white" value="Twitt" />
            </form>
        </div>
    </div>

    <div class="mt-2 flex flex-col space-y-2">
        @foreach ($tweets as $tweet)
            <div class="card my-4 bg-white">
                <div class="card-body">
                    <div class="text-black">
                        <h2 class="text-xl font-bold">{{ $tweet->user->name }}</h2>
                        <span class="text-xs">{{ $tweet->created_at->diffForHumans() }}</span>
                        <p>{{ $tweet->content }}</p>
                    </div>
                    <div class="card-actions text-end text-xs justify-end">
                        <a href="{{ route('tweets.show', $tweet) }}" class="link link-hover btn btn-info text-white">Komentar</a>
                        <a href="{{ route('tweets.edit', $tweet->id) }}" class="link link-hover btn btn-success text-white">Edit</a>
                        <form action="{{ route('tweets.destroy', $tweet->id) }}" method="POST" class="">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-error text-white">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
