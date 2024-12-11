<?php
$host = 'localhost';
$db = 'websitedb';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the 3 most recent posts
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created DESC LIMIT 3");
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
        <title>Recent Posts</title>
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
                    <button class="login-btn" onclick="location.href='login.php'">Login</button>
                </div>
            </div>
            <section class="banner">
                <div class="banner-text">
                    <h1>Recent Posts</h1>
                    <p>The latest from our blog</p>
                </div>
            </section>
        </header>

        <div class="content-container">
            <main class="content">
                <?php if ($posts): ?>
                    <?php foreach ($posts as $post): ?>
                        <article class="post">
                            <div class="articlephoto">
                                <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                            </div>
                            <h2><?= htmlspecialchars($post['title']) ?></h2>
                            <p><?= substr($post['content'], 0, 100) ?>...</p>
                            <small>Posted on: <?= htmlspecialchars($post['created']) ?></small>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No recent posts to display.</p>
                <?php endif; ?>
            </main>
        </div>

        <aside class="sidebar">
                <ul>
                    <li><a href="recent.php">Latest Posts</a></li>
                    <li><a href="related.php">Related Post</a></li>
                    <li><a href="category.php">Post Category</a></li>
                </ul>
            </aside>

        <footer>
            <div class="footer-text">
                <h1>ALL RIGHTS RESERVED</h1>
            </div>
        </footer>

        <script src="scripts.js"></script>
    </body>
</html>
