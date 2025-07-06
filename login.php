<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM managers WHERE username = ? AND password = SHA2(?, 256)");

    if (!$stmt) {
        die("Lỗi SQL: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password); // OK vì SHA2 chạy trong SQL

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['manager'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Sai tên đăng nhập hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/auth.css">
</head>

<body>
    <div class="login-wrapper">
        <form method="post" class="login-box">
            <h2>🔐 Đăng nhập</h2>

            <?php if (!empty($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <label for="username">👤 Tên đăng nhập</label>
            <input type="text" name="username" id="username" required>

            <label for="password">🔑 Mật khẩu</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">➡️ Đăng nhập</button>
        </form>
    </div>
</body>

</html>