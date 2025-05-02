<?php
$conn = include 'db.php';

function handelLogin($conn, $email, $password)
{
    if (empty($email) || empty($password)) {
        echo "<p class='text-red-500 text-center mt-4'>Please fill all the fields</p>";
        return;
    }

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<p class='text-red-500 text-center mt-4'>Invalid email or password</p>";
    } else {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set token/cookie or session if needed
            header("Location: index.php");
            exit;
        } else {
            echo "<p class='text-red-500 text-center mt-4'>Invalid email or password</p>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    handelLogin($conn, $email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Login
            </button>
        </form>
        <p class="text-sm text-center text-gray-600 mt-4">
            Don't have an account? <a href="/todoinphp/signup.php" class="text-blue-500 hover:underline">Register</a>
        </p>
    </div>
</body>
</html>
