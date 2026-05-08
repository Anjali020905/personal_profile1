<?php include 'data.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | <?php echo htmlspecialchars($data['personal']['role']); ?></title>
    <!-- Google Fonts: Inter, Playfair Display, Caveat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Link to custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#home" class="logo"><?php echo htmlspecialchars($data['personal']['name']); ?></a>
            <div class="nav-links" id="nav-links">
                <a href="#home">Home</a>
                <a href="#portfolio">Projects</a>
                <a href="#articles">Articles</a>
                <a href="#contact">Contact</a>
                <button id="theme-toggle" class="theme-toggle" aria-label="Toggle Dark Mode">🌓</button>
            </div>
            <!-- Hamburger menu for mobile -->
            <div class="hamburger" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="home" class="hero magazine-hero">
        <div class="hero-content fade-in">
            <h1 class="hero-title">Hi, I'm <?php echo explode(' ', htmlspecialchars($data['personal']['name']))[0]; ?>!</h1>
            <p class="hero-subtitle"><?php echo htmlspecialchars($data['personal']['role']); ?></p>
        </div>
        <div class="magazine-layout fade-in">
            <!-- Center Image -->
            <div class="center-image-container">
                <img src="assets/profile.jpeg" alt="Profile" class="center-image">
            </div>

            <!-- Floating texts -->
            <div class="floating-text text-top-left">
                <p><?php echo htmlspecialchars($data['personal']['hero_floating_texts']['age_details']); ?></p>
                <svg class="arrow arrow-top-left" viewBox="0 0 100 100"><path d="M80,20 Q60,80 100,90" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><polygon points="100,90 90,85 95,95" fill="currentColor"/></svg>
            </div>

            <div class="floating-text text-top-right">
                <p><?php echo htmlspecialchars($data['personal']['hero_floating_texts']['location']); ?></p>
                <svg class="arrow arrow-top-right" viewBox="0 0 100 100"><path d="M20,20 Q40,80 0,90" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><polygon points="0,90 10,85 5,95" fill="currentColor"/></svg>
            </div>

            <div class="floating-text text-bottom-left">
                <svg class="arrow arrow-bottom-left" viewBox="0 0 100 100"><path d="M80,80 Q60,20 100,10" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><polygon points="100,10 90,15 95,5" fill="currentColor"/></svg>
                <p><?php echo htmlspecialchars($data['personal']['hero_floating_texts']['skills']); ?></p>
            </div>

            <div class="floating-text text-bottom-right">
                <svg class="arrow arrow-bottom-right" viewBox="0 0 100 100"><path d="M20,80 Q40,20 0,10" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><polygon points="0,10 10,15 5,5" fill="currentColor"/></svg>
                <p><?php echo htmlspecialchars($data['personal']['hero_floating_texts']['hobbies']); ?></p>
            </div>
        </div>
    </header>

    <!-- Main Content (3-column layout on desktop) -->
    <section id="portfolio" class="main-layout fade-in">
        <div class="container flex-row">
            
            <!-- Column 1: Projects -->
            <div class="col">
                <h2 class="section-title">Projects</h2>
                <div class="card-list">
                    <?php foreach ($data['projects'] as $project): ?>
                    <div class="card">
                        <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                        <p><?php echo htmlspecialchars($project['description']); ?></p>
                        <a href="<?php echo htmlspecialchars($project['link']); ?>" class="btn-link">View Project</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>



            <!-- Column 3: Education -->
            <div class="col">
                <h2 class="section-title">Education</h2>
                <div class="card-list">
                    <div class="card edu-card">
                        <h3><?php echo htmlspecialchars($data['education']['degree']); ?></h3>
                        <p class="cgpa">CGPA: <?php echo htmlspecialchars($data['education']['cgpa']); ?></p>
                        <br>
                        <h4>Relevant Courses:</h4>
                        <ul class="courses-list">
                            <?php foreach ($data['education']['courses'] as $course): ?>
                            <li><?php echo htmlspecialchars($course); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Articles Section -->
    <?php if (!empty($data['articles'])): ?>
    <section id="articles" class="articles fade-in">
        <div class="container">
            <h2 class="section-title text-center">Recent Articles</h2>
            <div class="flex-row justify-center">
                <?php foreach ($data['articles'] as $article): ?>
                <div class="card article-card">
                    <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                    <p><?php echo htmlspecialchars($article['description']); ?></p>
                    <a href="<?php echo htmlspecialchars($article['link']); ?>" class="btn-link">Read More</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Reviews Section -->
    <?php if (!empty($data['reviews'])): ?>
    <section id="reviews" class="reviews bg-alt fade-in">
        <div class="container">
            <h2 class="section-title text-center">Reviews</h2>
            <div class="flex-row">
                <?php foreach ($data['reviews'] as $review): ?>
                <div class="card review-card">
                    <p class="review-text">"<?php echo htmlspecialchars($review['text']); ?>"</p>
                    <p class="reviewer">- <?php echo htmlspecialchars($review['reviewer']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contact Section -->
    <section id="contact" class="contact fade-in">
        <div class="container">
            <h2 class="section-title text-center">Get In Touch</h2>
            <div class="form-container">
                <div id="form-message" class="form-message hidden"></div>
                <!-- Contact Form posting to PHP -->
                <form id="contact-form" action="contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Your Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container flex-row justify-between align-center footer-content">
            <p>&copy; <?php echo htmlspecialchars($data['personal']['footer_year']); ?> <?php echo htmlspecialchars($data['personal']['name']); ?>. All rights reserved.</p>
            <div class="social-links">
                <?php foreach ($data['personal']['socials'] as $name => $url): ?>
                <a href="<?php echo htmlspecialchars($url); ?>"><?php echo htmlspecialchars($name); ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </footer>

    <!-- Link to custom JavaScript -->
    <script src="script.js"></script>
</body>
</html>
