<?php

include('db.php');

$token = isset(($_COOKIE['assessToken']));
if (!$token) {
    header("Location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App in PHP</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
</head>

<body>
    <?php

    echo "<p class='text-white round-sm mb-5 text-center mt-4 p-2 bg-green-700'>Welcome to the Todo App</p>";

    $query = "SELECT id, title, description, created_at FROM notes";
    $result = mysqli_query($conn, $query);

    $totalNotes = mysqli_num_rows($result); // Count total notes

    if ($totalNotes > 0) {
        echo "<p class='text-center text-gray-700 mb-4'>Total Notes: $totalNotes</p>"; // Display total notes
        echo "<div class='container mx-auto px-4'>";
        echo "<div class='grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='bg-white shadow-md rounded-lg p-4'>";
            echo "<h2 class='text-lg font-bold text-gray-800 mb-2'>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p class='text-gray-600 mb-4'>" . htmlspecialchars($row['description']) . "</p>";
            echo "<p class='text-sm text-gray-500 mb-4'>Created At: " . htmlspecialchars($row['created_at']) . "</p>";
            echo "<div class='flex justify-between items-center'>";
            echo "<button class='bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mr-2'><a href='edit?id=" . $row['id'] . "'> Edit </a></button>";
            echo "<button class='bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600'><a href='delete?id=" . $row['id'] . "'> Delete </a> </button>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p class='text-center text-gray-500 mt-4'>No notes found.</p>";
    }

    ?>
</body>

</html>