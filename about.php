<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About - Tech & Innovation Forum</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <nav>
      <ul class="navigation-menu">
        <li><a href="home.php">Home</a></li>
        <li><a href="about.php" class="active">About</a></li>
        <li><a href="forum.php">Forum</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <li><a href="logout.php">Logout Here (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
        <?php else: ?>
          <li><a href="index.php">Login</a></li>
          <li><a href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1497215842964-222b430dc094?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80')">
      <h1>About Our Community</h1>
      <p>
        Learn about our mission, values, and the team behind the Tech & Innovation Forum
      </p>
    </section>

    <section class="about-section" style="padding: 50px 20px;">
      <div style="max-width: 1000px; margin: 0 auto;">
        <div style="display: flex; flex-wrap: wrap; gap: 40px; align-items: center; margin-bottom: 50px;">
          <div style="flex: 1; min-width: 300px;">
            <h2 class="section-title">Our Mission</h2>
            <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 20px;">
              At the GCTU Connect Forum, our mission is to create a vibrant community where technology enthusiasts, professionals, and innovators can connect, collaborate, and drive technological progress forward. We believe that by sharing knowledge and fostering meaningful discussions, we can accelerate innovation and solve complex challenges.
            </p>
            <p style="font-size: 1.1rem; line-height: 1.8;">
              We're committed to building an inclusive environment where diverse perspectives are valued and everyone feels empowered to contribute to the conversation about technology's role in shaping our future.
            </p>
          </div>
          <div style="flex: 1; min-width: 300px;">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Team Collaboration" style="width: 100%; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
          </div>
        </div>
        
        <h2 class="section-title">Our Values</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 30px;">
          <div style="background: #f8f9ff; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 3rem; color: var(--primary); margin-bottom: 15px;">🤝</div>
            <h3 style="color: var(--primary); margin-bottom: 15px;">Collaboration</h3>
            <p>We believe that together we can drive significant advancements in technology and innovation.</p>
          </div>
          
          <div style="background: #f8f9ff; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 3rem; color: var(--primary); margin-bottom: 15px;">💡</div>
            <h3 style="color: var(--primary); margin-bottom: 15px;">Innovation</h3>
            <p>Our goal is to keep pace with the ever-changing world of technology and foster creative thinking.</p>
          </div>
          
          <div style="background: #f8f9ff; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 3rem; color: var(--primary); margin-bottom: 15px;">🌍</div>
            <h3 style="color: var(--primary); margin-bottom: 15px;">Inclusivity</h3>
            <p>Everyone is welcome to share their voice and expertise regardless of background or experience level.</p>
          </div>
        </div>
      </div>
    </section>
    
    <section style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 70px 20px; text-align: center;">
      <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2rem; margin-bottom: 20px;">Join Our Growing Community</h2>
        <p style="font-size: 1.2rem; margin-bottom: 30px;">
          Become part of a network of passionate individuals shaping the future of technology.
        </p>
        <a href="register.php" class="btn" style="background: white; color: var(--primary);">Create a Thread</a>
      </div>
    </section>
  </main>

<footer>
  <nav>
    <ul class="footer-links">
      <li><a href="#" class="footer-link" data-modal="privacy-modal">Privacy Policy</a></li>
      <li><a href="#" class="footer-link" data-modal="terms-modal">Terms of Service</a></li>
      <li><a href="#" class="footer-link" data-modal="contact-modal">Contact Us</a></li>
    </ul>
    <div class="copyright">
      &copy; 2025 GCTU Connect. All rights reserved.
    </div>
  </nav>
</footer>

  <script src="script.js"></script>
  <!-- Modal Popups -->
<div id="privacy-modal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <h2>Privacy Policy</h2>
    <p>
      This Privacy Policy explains how your personal information is collected, used, and disclosed by our forum. We prioritize the protection of your data and adhere to responsible privacy practices.
    </p>
    <p>
      We collect personal data—such as email addresses and usernames—only when you voluntarily provide it during registration or when filling out contact forms. This information is used solely to enhance your user experience, communicate updates, and tailor content.
    </p>
    <p>
      Your data is never shared with third parties without your consent, except as required by law. We utilize proper security measures including encryption and regular audits to safeguard your information.
    </p>
    <p>
      By using our forum, you consent to our data collection and processing practices as described in this Privacy Policy.
    </p>
  </div>
</div>

<div id="terms-modal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <h2>Terms of Service</h2>
    <h3>1. Acceptance of Terms</h3>
    <p>By accessing or using the GCTU Connect Forum, you agree to be bound by these Terms of Service.</p>
    
    <h3>2. User Responsibilities</h3>
    <p>You are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer.</p>
    
    <h3>3. Content Guidelines</h3>
    <p>You agree not to post any abusive, obscene, or otherwise inappropriate content. All discussions should be respectful and relevant to technology and innovation topics.</p>
    
    <h3>4. Intellectual Property</h3>
    <p>You retain ownership of any content you post, but grant us a license to display and distribute it on our platform.</p>
    
    <h3>5. Termination</h3>
    <p>We reserve the right to terminate your access to the forum at any time without notice for violations of these terms.</p>
  </div>
</div>

<div id="contact-modal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <h2>Contact Us</h2>
    <p>Have questions or need assistance? Reach out to us through any of these channels:</p>
    
    <div class="contact-methods">
      <div class="contact-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
          <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
          <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
        </svg>
        <span>https://site.gctu.edu.gh/</span>
      </div>
      
      <div class="contact-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
          <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
        </svg>
        <span>059-867-0195</span>
      </div>
      
      <div class="contact-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
          <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
        </svg>
        <span>GCTU Tesano Accra (Nsawam Road)</span>
      </div>
    </div>
    
    <p>You can also use our <a href="contact.php">contact form</a> to send us a message directly.</p>
  </div>
</div>
</body>
</html>