<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            height: 40px;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        #response {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <form id="editArticleForm">
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        <input type="text" name="title" value="<?php echo $article['title']; ?>" required>
        <textarea name="description" required><?php echo $article['description']; ?></textarea>
        <select name="category" required>
            <option value="Food" <?php if($article['category'] == 'Food') echo 'selected'; ?>>Food</option>
            <option value="Education" <?php if($article['category'] == 'Education') echo 'selected'; ?>>Education</option>
            <option value="Business" <?php if($article['category'] == 'Business') echo 'selected'; ?>>Business</option>
            <option value="Position" <?php if($article['category'] == 'Position') echo 'selected'; ?>>Position</option>
        </select>
        <button type="submit">Update Article</button>
    </form>

    <div id="response"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#editArticleForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'update_article.php',
                data: $(this).serialize(),
                success: function(response) {
                    $('#response').text(response);
                }
            });
        });
    });
    </script>
</body>
</html>
