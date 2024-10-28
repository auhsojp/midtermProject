<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Note</title>
    <link rel="stylesheet" href="{{ asset('css/view.css') }}">  
</head>
<body>
    <h1 class="title">View Note</h1>
    <div>
        <button class="back-button" onclick="location.href='{{ route('notes.index') }}'">
            <span>&#8617;</span>
        </button>
    </div>
    <div>
        @if(session()->has('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="note-view-container">
        <h2 class="note-title">{{ $note->title ?? 'Untitled' }}</h2>
        <small class="desc-note">
            Created: {{ \Carbon\Carbon::create($note->created_at)->diffForHumans() }} | Last edited: {{ \Carbon\Carbon::create($note->updated_at)->diffForHumans() }}
            | <p class="char-count">Characters: </p>
        </small>
        <hr>
        <div class="note-content">
            <p id="content-char">{{ $note->content }}</p>
        </div>
    </div>

    <div class="note-actions">
        <form action="{{ route('notes.view-edit', ['note' => $note->id]) }}" method="get">
            <button type="submit" class="edit-button">
                <span>&#9999;</span>
            </button>
        </form>
        <form method="post" action="{{ route('notes.delete', ['note' => $note]) }}" class="delete-form"
            onsubmit="return confirm('Are you sure you want to delete this note?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-button">
                <span>&#128465;</span>
            </button>
        </form>
    </div>

    <script>
        //character count function
        document.addEventListener('DOMContentLoaded', function () {
            const noteContentElement = document.getElementById('content-char');
            const charCountElement = document.querySelector('.char-count');
            const maxChars = 10000;

            // Get the text content of the note and calculate its length.
            const noteText = noteContentElement.textContent || noteContentElement.innerText;
            const currentLength = noteText.length;

            // Display the character count.
            charCountElement.textContent = `Characters: ${currentLength}`;
        });
    </script>
</body>
</html>
