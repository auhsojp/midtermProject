<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Notes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'times new roman', sans-serif;
        }

        body {
            background: rgb(54,84,105);
            background: linear-gradient(90deg, rgba(54,84,105,1) 0%, rgba(27,36,68,1) 29%, rgba(10,4,43,1) 48%, rgba(71,102,110,1) 49%, rgba(7,7,45,1) 100%, rgba(12,25,116,1) 100%, rgba(1,7,57,1) 100%, rgba(67,94,92,1) 100%);-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        h1 {
            font-size: 4rem;    
            color: rgb(87,149,193);
            color: linear-gradient(90deg, rgba(87,149,193,1) 0%, rgba(171,251,255,1) 50%, rgba(10,4,43,1) 50%, rgba(152,147,147,1) 50%, rgba(26,37,77,1) 98%, rgba(7,7,45,1) 100%, rgba(12,25,116,1) 100%, rgba(1,7,57,1) 100%, rgba(67,94,92,1) 100%);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }

        button {
            padding: 15px 30px;
            font-size: 1.2rem;
            background-color: darkred;
            color: pink;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        button:hover {
            background-color: lightcoral;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            button {
                font-size: 1rem;
                padding: 12px 25px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }

            button {
                font-size: 0.9rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <h1>Welcome to Your Notes</h1>
    <form method="get" action="{{ route('notes.log')}}">
        @csrf
        @method('get')
        <button type="submit">Go to Your Notes</button>
    </form>
</body>
</html>
