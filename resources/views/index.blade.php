<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notes</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>    
    <h1 class="title">📝 My Notes</h1>
    <a href="/" class="home-button" title="Back to Home">
        <span class="home-icon">&#8962;</span>
    </a>
    <div>
        @if(session()->has('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="notes-container">
        @foreach ($notes as $note)
            <div class="note-card" title="View Note" onclick="redirectToNoteView('{{ route('notes.view', ['note' => $note->id]) }}')">
                <h2>{{ $note->title ?? 'Untitled' }}</h2>
                <p class="content-char">{{ $note->content }}</p>
                <small class="note-desc">
                    Created: {{ \Carbon\Carbon::create($note->created_at)->diffForHumans() }} 
                    @if($note->updated_at != $note->created_at)
                        | Last edited: {{ \Carbon\Carbon::create($note->updated_at)->diffForHumans() }}
                    @endif
                </small> 
                <div class="options" onclick="event.stopPropagation();">
                    <span class="options-icon" onclick="toggleDropdown(event)">&#8942;</span>
                    <div class="buttons">
                        <form action="{{ route('notes.index-edit', ['note' => $note->id]) }}" method="get">
                            <button type="submit" class="edit-button">
                                <span>&#9999;</span>
                            </button>
                        </form>
                        <form class="delete-form" action="{{ route('notes.delete', ['note' => $note->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">
                                <span>&#128465;</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <span>
            <button class="add-note" onclick="location.href='{{ route('notes.create') }}'" title="Add New Note">
                <span>✏️</span>
            </button>
        </span>
    </div>  

    <script>
        function redirectToNoteView(url) {
            window.location.href = url;
        }

        function toggleDropdown(event) {
            event.stopPropagation();
            const dropdown = event.currentTarget.nextElementSibling;

            document.querySelectorAll('.buttons').forEach(d => {
                if (d !== dropdown) {
                    d.style.display = 'none';
                }
            });

            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        window.addEventListener('click', function () {
            document.querySelectorAll('.buttons').forEach(dropdown => {
                dropdown.style.display = 'none';
            });
        });
    </script>
</body>
</html>
