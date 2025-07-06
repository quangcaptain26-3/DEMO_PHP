<?php
session_start();
if (!isset($_SESSION['manager'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

$id = intval($_GET['id']);
$query = $conn->query("SELECT s.name, d.student_code, d.gpa, d.math, d.literature, d.english 
                       FROM students s
                       JOIN student_details d ON s.id = d.student_id
                       WHERE s.id = $id");

if ($row = $query->fetch_assoc()) {
    echo "<p><strong>Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
    echo "<p><strong>Student Code:</strong> " . htmlspecialchars($row['student_code']) . "</p>";
    echo "<p><strong>GPA:</strong> " . htmlspecialchars($row['gpa']) . "</p>";
    echo "<p><strong>Math:</strong> " . htmlspecialchars($row['math']) . "</p>";
    echo "<p><strong>Literature:</strong> " . htmlspecialchars($row['literature']) . "</p>";
    echo "<p><strong>English:</strong> " . htmlspecialchars($row['english']) . "</p>";
} else {
    echo "<p>❌ No detail information available for this student.</p>";
}
?>
