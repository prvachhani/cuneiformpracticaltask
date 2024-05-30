<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

    $stmt = $conn->prepare("UPDATE articles SET title = ?, description = ?, category = ?, slug = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $description, $category, $slug, $id);

    if ($stmt->execute()) {
        echo "Article updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
