<?php
include 'db.php';

$result = $conn->query("SELECT * FROM articles ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Articles</title>
    <link rel="stylesheet" href="/thecuneiform/style.css">
</head>
<body>
    <div class="container">
        <button type="button" onclick="window.location.href='/thecuneiform/create_article.html'">Create Article</button>
        <input type="text" id="search" placeholder="Search articles...">
        <div id="articles"></div>
        <div id="articles-list">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="article">
                    <h2><?php echo $row['title']; ?></h2>
                    <p><?php echo $row['description']; ?></p>
                    <p>Category: <?php echo $row['category']; ?></p>
                    <p><a href="edit_article.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="delete_article.php?id=<?php echo $row['id']; ?>">Delete</a></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/thecuneiform/script.js"></script>
</body>
</html>

<?php
$conn->close();
?>
