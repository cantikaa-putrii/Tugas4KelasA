<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ambil domain dari email
    $emailParts = explode('@', $email);
    if (count($emailParts) == 2) {
        $domain = $emailParts[1];
    } else {
        $domain = ''; // Jika email tidak valid
    }

    // Cek apakah password sesuai dengan domain
    if ($password === $domain) {
        $_SESSION['user'] = $email;
        header('Location: index.php');
        exit();
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #008B8B, #004D4D);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    width: 100%;
    max-width: 400px;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
    transition: transform 0.3s ease-in-out;
}

.container:hover {
    transform: translateY(-5px);
}

h1 {
    margin-bottom: 20px;
    color: #008B8B;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border 0.3s ease-in-out;
}

input:focus {
    border-color: #008B8B;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 139, 139, 0.5);
}

button {
    width: 100%;
    padding: 12px;
    background: #008B8B;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

button:hover {
    background: #006666;
    transform: scale(1.05);
}

.error {
    color: red;
    margin-bottom: 15px;
    font-weight: bold;
}

