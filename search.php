<?php
include 'db.php';

$search = $_POST['search'];

$result = $conn->query("SELECT * FROM articles WHERE title LIKE '%$search%' OR description LIKE '%$search%' ORDER BY created_at DESC");

$articles = [];
while ($row = $result->fetch_assoc()) {
    $articles[] = $row;
}

echo json_encode($articles);
?>
