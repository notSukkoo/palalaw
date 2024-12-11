<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="blog.css">
        <title>Post Categories</title>
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
        </header>

        <section class="banner">
            <div class="banner-text">
                <h1>Post Categories</h1>
                <p>Different Categories</p>
            </div>
        </section>

        <div class="content-container">
            <main class="content">
                <div class="category-section">
                    <h2>Categories</h2>
                    <ul class="category-list">
                        <li><a href="#">Digital Art</a></li>
                        <li><a href="#">Tutorials</a></li>
                        <li><a href="#">Tools & Software</a></li>
                        <li><a href="#">Inspiration</a></li>
                        <li><a href="#">Others</a></li>
                    </ul>
                </div>
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
