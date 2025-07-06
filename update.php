<?php
session_start();
if (!isset($_SESSION['manager'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';
$id = intval($_GET['id']); 

$result = $conn->query("SELECT * FROM students WHERE id = $id");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE students SET name=?, email=?, phone=?, address=? WHERE id=?");
    $stmt->bind_param("ssssi", $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật sinh viên</title>
    <link rel="stylesheet" href="public/form.css">
    <script src="public/main.js" defer></script>
</head>
<body>
    <div class="form-wrapper">
        <h1 class="form-title">✏️ Cập nhật sinh viên</h1>
        <form method="post" id="studentForm" class="form-container">
            <label>Họ và tên</label>
            <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>

            <label>Số điện thoại</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>">

            <label>Địa chỉ</label>
            <input type="text" name="address" value="<?= htmlspecialchars($data['address']) ?>">

            <button type="submit">✅ Cập nhật</button>
            <a href="index.php" class="back-link">← Trở lại</a>
        </form>
    </div>
</body>
</html>