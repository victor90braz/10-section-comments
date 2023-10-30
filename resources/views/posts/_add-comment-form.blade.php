@auth
    <x-panel>
        <form action="{{ $post->slug }}/comments" method="POST">
            @csrf

            <header class="flex justify-center items-center">
                @auth
                    <img class="rounded-full" src="https://i.pravatar.cc/100?u={{ auth()->user()->id }}" alt="avatar user" style="width: 100px">
                @else
                    <img class="rounded-full" src="https://i.pravatar.cc/100" alt="default avatar" width="100">
                @endauth

                <h2 class="ml-4">Want to participate?</h2>
            </header>

            <main class="mt-6">
                <textarea name="body"
                        class="w-full text-sm focus:outline-none focus:ring border border border-gray-300"
                        cols="30"
                        rows="5"
                        required
                        placeholder="Quick, think of something to say!">
                </textarea>

                @error('body')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </main>

            <div class="mt-1 flex justify-end">
                <x-submit-button>Post</x-submit-button>
            </div>
        </form>
    </x-panel>
@else
    <x-panel class="flex justify-center mt-4">
            <p class="text-lg font-semibold">
                <a href="/register" class="text-blue-500 hover:underline">Register</a> or
                <a href="/login" class="text-blue-500 hover:underline">Login</a> to leave a comment.
            </p>
    </x-panel>
@endauth
