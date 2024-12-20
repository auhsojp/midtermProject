<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Note</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <?php date_default_timezone_set('Asia/Manila');?>
    <h1 class="title">Create New Note</h1>
    <div>
        <button class="back-button" onclick="location.href='{{ route('notes.index') }}'">
            <span>&#8617;</span>
        </button>
    </div>

    <div class="note-create-container">
        <form method="post" action="{{ route('notes.save') }}" class="create-form" onsubmit="return validateForm()">
            @csrf  
            @method('post')
            <div class="form-group">
                <label for="title" class="content-name">Title</label>
                <input type="text" name="title" id="title" class="note-title" placeholder="Untitled">
                <div class="current-time" id="currentTime">
                    Date Today: {{ \Carbon\Carbon::now()->format('F d, h:i A') }}
                </div>
            </div> 
            <div class="form-group">
                <label for="content" class="content-name">Content</label>
                <small class="char-count">0 / 10000 characters</small>
                <textarea name="content" id="content" class="note-content" rows="5" placeholder="Write here..."></textarea>
            </div>
            <div class="save-button-container">
                <input type="submit" value="&#10004;" class="save-button">
            </div>
        </form>
    </div>
    <script>
        // Function to update the current time
        function updateCurrentTime() {
            const now = new Date();
            const options = { 
                month: 'long', 
                day: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit', 
                hour12: true 
            };
            const formattedTime = now.toLocaleString('en-US', options);
            document.getElementById('currentTime').textContent = `Date Today: ${formattedTime}`;
        }

        // Update the time immediately and then every minute
        updateCurrentTime();
        setInterval(updateCurrentTime, 60000); // Update every minute

        // Character count functionality
        document.addEventListener('DOMContentLoaded', function () {
            const contentInput = document.getElementById('content');
            const charCount = document.querySelector('.char-count');
            const maxChars = 10000;

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

        // Form validation function
        function validateForm() {
            const title = document.getElementById('title').value.trim();
            const content = document.getElementById('content').value.trim();
            const maxChars = 10000;

            if (content.length === 0) {
                alert("The content is empty. Please write something.");
                return false; // Prevent form submission
            }

            if (content.length > maxChars) {
                alert("You exceed the limit of 10,000 characters.");
                return false; // Prevent form submission
            }

            return confirm('Are you sure you want to save this note?'); // Allow form submission
        }
    </script>
</body>
</html>
