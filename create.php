<?php
session_start();
if (!isset($_SESSION['manager'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO students (name, email, phone, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address']);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="public/form.css">
    <script src="public/main.js" defer></script>
</head>
<body>
    <div class="form-wrapper">
        <h1 class="form-title">➕ Thêm sinh viên</h1>
        <form method="post" id="studentForm" class="form-container">
            <label>Họ và tên</label>
            <input type="text" name="name" placeholder="Nguyễn Văn A" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="a@example.com" required>

            <label>Số điện thoại</label>
            <input type="text" name="phone" placeholder="09xxxxxxxx">

            <label>Địa chỉ</label>
            <input type="text" name="address" placeholder="Hà Nội">

            <button type="submit">💾 Lưu</button>
            <a href="index.php" class="back-link">← Trở lại</a>
        </form>
    </div>
</body>
</html>
