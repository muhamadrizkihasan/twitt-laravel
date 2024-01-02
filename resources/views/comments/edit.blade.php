<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl bg-base-100 sm:px-6 lg:p-8 bg-white">
            <form action="{{ route('comments.update', [$comment->tweet->id, $comment]) }}" class="form-control" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 w-full">
                    <textarea class="textarea textarea-bordered w-full bg-white" cols="30" name="message" placeholder="Edit postiangan..." rows="3">{{ $comment->message }}</textarea>
                </div>
                <div>
                    <input type="submit" value="Edit" class="btn btn-success mt-3 text-white">
                </div>
            </form>
        </div>
    </div>
</x-app-layout>