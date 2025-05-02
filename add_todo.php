<?php
include 'db.php'; // Assuming this sets $conn

$accessToken = isset($_COOKIE['accessToken']);
if (!$accessToken) {
    header("Location: login.php");
    exit;
}

$title = $_POST['title'] ?? null;
$description = $_POST['description'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $title && $description) {
    $sql = "INSERT INTO notes (title, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $description);

    if ($stmt->execute()) {
        echo "<p class='text-white round-sm mb-5 text-center mt-4 p-2 bg-green-700'>Todo added successfully</p>";
    } else {
        echo "<p class='text-white round-sm mb-5 text-center mt-4 p-2 bg-red-700'>Failed to add todo</p>";
    }

    $stmt->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Todo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Add New Todo</h1>
        <form method="POST">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" id="title" name="title"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter todo title" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter todo description"></textarea>
            </div>

            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Add
                Todo</button>
        </form>
    </div>
</body>

</html>