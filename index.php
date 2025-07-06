<?php
session_start();
if (!isset($_SESSION['manager'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';
$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="public/style.css">
    <script defer src="public/main.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <h1>📋 Danh sách sinh viên</h1>
            <form class="search-form" onsubmit="return false;">
                <input type="text" id="searchInput" placeholder="Tìm theo tên hoặc email...">
                <button type="submit">🔍 Tìm kiếm</button>
            </form>
            <a href="create.php" class="add-button">➕ Thêm sinh viên</a>
            <div class="logout-bar">
                👋 Xin chào, <strong><?= htmlspecialchars($_SESSION['manager']) ?></strong>
                <a href="logout.php" class="logout-btn">🚪 Đăng xuất</a>
            </div>

        </header>

        <table id="studentTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['address']) ?></td>
                        <td class="actions">
                            <a href="update.php?id=<?= $row['id'] ?>" class="edit">✏️</a>
                            <a href="index.php?delete=<?= $row['id'] ?>" class="delete" onclick="return confirm('Xoá sinh viên này?')">❌</a>
                            <a href="#" class="details" data-id="<?= $row['id'] ?>">🔍</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal chi tiết -->
    <div id="detailModal" class="modal hidden">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>📄 Chi tiết sinh viên</h3>
            <div id="modalBody">Đang tải...</div>
        </div>
    </div>
</body>

</html>