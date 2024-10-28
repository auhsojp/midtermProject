<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
    <?php date_default_timezone_set('Asia/Manila');?>
    <h1 class="title">Edit Note</h1>
    <div>
        <button class="back-button" onclick="location.href='{{ route('notes.index') }}'">
            <span>&#8617;</span>
        </button>
    </div>
    <div class="note-edit-container">
        <form method="post" action="{{ route('notes.index-update', ['note' => $note]) }}" class="edit-form" onsubmit="return validateForm();">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title" class="content-name">Title</label>
                <input type="text" name="title" id="title" class="note-title" placeholder="Untitled" value="{{ $note->title }}">
                <div class="current-time">
                    Date Today: {{ \Carbon\Carbon::now()->format('F d, h:i A') }}
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="content-name">Content</label>
                <small class="char-count">0 / 10000 characters</small>
                <textarea name="content" id="content" class="note-content" rows="5" placeholder="Your note content">{{ $note->content }}</textarea>
            </div>
            <div class="update-button-container">
                <input type="submit" value="&#10004;" class="update-button">
            </div>
        </form>
    </div>  

    <script>
        // Character count functionality
        document.addEventListener('DOMContentLoaded', function () {
            const contentInput = document.getElementById('content');
            const charCount = document.querySelector('.char-count');
            const maxChars = 10000; // Adjust the maximum character limit as needed

            contentInput.addEventListener('input', function () {
                const currentLength = contentInput.value.length;
                charCount.textContent = `${currentLength} / ${maxChars} characters`;

                // Optional: Change color when reaching character limit
                if (currentLength > maxChars) {
                    charCount.style.color = 'red';
                } else {
                    charCount.style.color = '';
                }
            });
        });

        // Form validation
        function validateForm() {
            const title = document.getElementById('title').value.trim();
            const content = document.getElementById('content').value.trim();
            const maxChars = 10000; // Same max chars as above

            if (content.length === 0) {
                alert("The content is empty. Please write something.");
                return false; // Prevent form submission
            }

            if (content.length > maxChars) {
                alert(`You exceeds the limit of ${maxChars} characters.`);
                return false; // Prevent form submission
            }

            return confirm('Are you sure you want to save the note?'); // Show confirmation prompt
        }
    </script>
</body>
</html>
