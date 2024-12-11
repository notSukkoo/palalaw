<?php
$host = 'localhost';
$db = 'websitedb';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all posts
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Stroke It With Your Hand</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="Navbar">
                <div class="left-spacer"></div>
                <ul class="Links">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="About.php">ABOUT</a></li>
                    <li><a href="profile.php">ME</a></li>
                </ul>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <button class="login-btn" onclick="location.href='logout.php'">Logout</button>
                <?php else: ?>
                    <button class="login-btn" onclick="location.href='login.php'">Login</button>
                <?php endif; ?>
            </div>
        </div>
        <section class="banner">
            <div class="banner-text">
                <h1>STROKE IT WITH YOUR HAND</h1>
                <p>My process in creating digital artworks</p>
            </div>
        </section>
    </header>

    <div class="content-container">
        <main class="content">
            <?php foreach ($posts as $post): ?>
                <article class="post">
                    <div class="articlephoto">
                        <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                    </div>
                </article>
            <?php endforeach; ?>
        </main>

        <aside class="sidebar">
            <ul>
                <li><a href="recent.php">Latest Posts</a></li>
                <li><a href="related.php">Related Post</a></li>
                <li><a href="category.php">Post Category</a></li>
            </ul>
        </aside>
    </div>

    <footer>
        <div class="footer-text">
            <h1>ALL RIGHTS RESERVED</h1>
        </div>
    </footer>
    
    <script src="scripts.js"></script>

</body>
</html>
