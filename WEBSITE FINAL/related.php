<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="blog.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Related Posts - Stroke It With Your Hand</title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="Navbar">
                    <div class="left-spacer"></div>
                    <ul class="Links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="profile.php">Profile</a></li>
                    </ul>
                    <button class="login-btn" onclick="location.href='login.php'">Login</button>
                </div>
            </div>

            <section class="banner">
                <div class="banner-text">
                    <h1>RELATED POSTS</h1>
                </div>
            </section>
        </header>

        <div class="content-container">
            <main class="content">
                <h2>RELATED POST</h2>

                <article class="relatedpost">
                    <div class="relatedphoto">
                        <img src="imges/article 1.jpg" alt="related 1">
                    </div>
                    <div class="post-content">
                        <h2>How I Got Started with Digital Art</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                    </div>
                </article>

                <article class="relatedpost">
                    <div class="relatedphoto">
                        <img src="imges/article 2.jpg" alt="related 2">
                    </div>
                    <div class="post-content">
                        <h2>Best Tools for Digital Artists</h2>
                        <p>Nullam vel velit sed magna eleifend tincidunt...</p>
                    </div>
                </article>

                <article class="relatedpost">
                    <div class="relatedphoto">
                        <img src="imges/article 3.jpg" alt="related 3">
                    </div>
                    <div class="post-content">
                        <h2>My Digital Art Workflow</h2>
                        <p>Quisque viverra, risus non aliquet viverra, orci erat ornare nulla...</p>
                    </div>
                </article>
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
