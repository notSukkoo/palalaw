<?php
session_start();

$host = 'localhost';
$db = 'websitedb';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Add post functionality
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        // Handle the image upload
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            echo "<script>alert('Please include an image to your post.'); window.history.back();</script>";
            exit();
        }

        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $uploadDir = 'image/'; // Ensure this directory exists and is writable
        $imagePath = $uploadDir . basename($imageName);

        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $image = $imagePath;
        } else {
            echo "<script>alert('Failed to upload image. Please try again.'); window.history.back();</script>";
            exit();
        }

        // Insert the new post into the database
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, category, image) VALUES (:title, :content, :category, :image)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);
        $stmt->execute();

        echo "<script>alert('Post added successfully!'); window.location.href = 'admin.php';</script>";
    }

    // Delete post functionality
    if (isset($_GET['delete_post'])) {
        $postId = $_GET['delete_post'];

        // Delete the post from the database
        $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $postId);
        $stmt->execute();

        echo "<script>alert('Post deleted successfully!'); window.location.href = 'admin.php';</script>";
    }

    // Logout functionality
    if (isset($_POST['logout-button'])) { // Check for the correct button name
        session_destroy(); // Destroy the session
        header('Location: index.php'); // Redirect to index.php
        exit();
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="blog.css">
        <title>Admin Panel</title>
        <style>
            .admin-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
                background-color: #f4f4f4;
                border-bottom: 1px solid #ccc;
            }

            .logout-form button {
                background-color: #d9534f;
                color: white;
                border: none;
                padding: 8px 12px;
                cursor: pointer;
                border-radius: 4px;
            }

            .logout-form button:hover {
                background-color: #c9302c;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="admin-header">
                <h1>Admin Panel</h1>
                <form method="POST" action="admin.php" class="logout-form">
                    <button type="submit" name="logout-button">Logout</button> <!-- Fixed logout button -->
                </form>
            </div>
        </header>

        <!-- Add Post Form -->
        <div class="admin-container">
            <h2>Add New Post</h2>
            <form method="POST" action="admin.php" enctype="multipart/form-data">
                <input type="hidden" name="add_post" value="1">

                <div class="input-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" required>
                </div>

                <div class="input-group">
                    <label for="content">Content:</label>
                    <textarea name="content" id="content" required></textarea>
                </div>

                <div class="input-group">
                    <label for="category">Category:</label>
                    <select name="category" id="category" required>
                        <option value="Digital Art">Digital Art</option>
                        <option value="Sketches">Sketches</option>
                        <option value="Concept Art">Concept Art</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image" accept="image/*" required>
                </div>

                <button type="submit">Add Post</button>
            </form>
        </div>

        <!-- Post Management (View Posts) -->
        <div class="admin-container">
            <h2>Manage Posts</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch and display all posts
                    $stmt = $pdo->query("SELECT * FROM posts");
                    while ($row = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['content']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                        echo "<td>";
                        if (!empty($row['image'])) {
                            echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Image' width='100'>";
                        } else {
                            echo "No Image";
                        }
                        echo "</td>";
                        echo "<td><a href='?delete_post=" . $row['id'] . "' class='delete-btn'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <footer>
            <p>© 2024 Website Admin Panel</p>
        </footer>
    </body>
</html>
