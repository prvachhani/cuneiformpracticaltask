<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

    $stmt = $conn->prepare("INSERT INTO articles (title, description, category, slug) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $category, $slug);

    if ($stmt->execute()) {
        echo "Article created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
