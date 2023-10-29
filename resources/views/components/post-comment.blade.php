@props(['comment'])

<article class="flex bg-gray-100 p-4 border-gray-200 rounded-xl space-x-4">
    <div style="flex-shrink: 0">
        <img class="rounded-xl" src="https://i.pravatar.cc/100?u={{ $comment->user_id }}" alt="avatar user" style="100px">
    </div>
    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{ $comment->author->username }}</h3>
            <p class="text-xs">
                Posted <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time>
            </p>
        </header>

        <main>
            <p>{{ $comment->body }}</p>
        </main>
    </div>
</article>


