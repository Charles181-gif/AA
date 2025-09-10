<?php
// home.php
require_once 'config.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home - GCTU Connect</title>
  <link rel="stylesheet" href="style1.css" />
</head>
<body>
  <?php include 'header.php'; ?>

  <main>
    <section class="hero">
      <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
      <p>
        Connect, collaborate, and innovate with fellow technology enthusiasts and professionals.
      </p>
      <a href="forum.php" class="btn">Explore the Forum</a>
    </section>

    <section class="featured">
      <h2 class="section-title">Featured Discussions</h2>
      <div class="feature-cards">
        <div class="card">
          <div class="card-img" style="background-image: url('https://images.unsplash.com/photo-1620712943543-bcc4688e7485?q=80&w=1530&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>

          <div class="card-content">
            <h3>AI Ethics</h3>
            <p>
              Explore critical debates and insights on the ethical implications of artificial intelligence.
            </p>
            <a href="forum.php" class="btn">Join Discussion</a>
          </div>
        </div>
        
        <div class="card">
          <div class="card-img" style="background-image: url('https://images.unsplash.com/photo-1563014959-7aaa83350992?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80')"></div>
          <div class="card-content">
            <h3>Cybersecurity Trends</h3>
            <p>
              Stay updated on the latest security tips, vulnerabilities, and breakthroughs.
            </p>
            <a href="forum.php" class="btn">Join Discussion</a>
          </div>
        </div>
        
        <div class="card">
          <div class="card-img" style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80')"></div>
          <div class="card-content">
            <h3>Startup Strategies</h3>
            <p>
              Discover innovative approaches to launching and growing tech startups.
            </p>
            <a href="forum.php" class="btn">Join Discussion</a>
          </div>
        </div>
      </div>
    </section>
    
    <section class="stats-section" style="margin-top: 50px; text-align: center;">
      <div style="display: flex; justify-content: space-around; flex-wrap: wrap;">
        <div style="padding: 20px;">
          <div style="font-size: 2.5rem; font-weight: bold; color: var(--primary);">1,200+</div>
          <div style="font-size: 1.1rem;">Active Members</div>
        </div>
        <div style="padding: 20px;">
          <div style="font-size: 2.5rem; font-weight: bold; color: var(--primary);">850+</div>
          <div style="font-size: 1.1rem;">Discussion Threads</div>
        </div>
        <div style="padding: 20px;">
          <div style="font-size: 2.5rem; font-weight: bold; color: var(--primary);">24/7</div>
          <div style="font-size: 1.1rem;">Community Support</div>
        </div>
      </div>
    </section>
  </main>

<?php include 'footer.php'; ?>
      </div>
    </div>
    
    <p>You can also use our <a href="contact.php">contact form</a> to send us a message directly.</p>
  </div>
</div>
</body>
</html>