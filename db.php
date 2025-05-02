<?php
$conn = mysqli_connect("localhost", "root", "", "todo_app_on_php");

if (!$conn) {
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>DB Connection Error</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class=" flex items-center justify-center h-screen">
        <div class="text-red-700 text-center">
            <h1 class="text-3xl font-bold">❌ Database Connection Failed</h1>
            <p class="mt-4 text-lg">Please check your database settings.</p>
        </div>
    </body>
    </html>';
    exit();
}
return $conn;
?>