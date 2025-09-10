<header>
  <div class="logo-container">
          <a class="logo">
              <div class="gctu">
                  <span class="highlight">G</span>CT<span class="highlight">U</span>
              </div>
              <div class="connect">Connect</div>
              <div class="connection-dots">
                  <div class="dot"></div>
                  <div class="dot"></div>
                  <div class="dot"></div>
              </div>
          </a>
      </div>
  <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" title="Menu">
    <span></span>
    <span></span>
    <span></span>
  </button>
  <nav id="mobile-nav">
    <ul class="navigation-menu">
      <li><a href="home.php" <?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'class="active"' : '' ?>> Home</a></li>
      <li><a href="about.php" <?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'class="active"' : '' ?>> About</a></li>
      <li><a href="forum.php" <?= basename($_SERVER['PHP_SELF']) == 'forum.php' ? 'class="active"' : '' ?>> Forum</a></li>
      <li><a href="contact.php" <?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'class="active"' : '' ?>> Contact</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="index.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>

<script>
function toggleMobileMenu() {
    const nav = document.getElementById('mobile-nav');
    nav.classList.toggle('active');
}
</script>