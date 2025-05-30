<?php
// index.php (landing page)
require_once __DIR__ . '/config.php'; // Use absolute path

// Redirect logged-in users to forum
if (isset($_SESSION['user_id'])) {
    header("Location: forum.php");
    exit();
}

$login_error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // The $pdo variable is now available from config.php
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: forum.php");
            exit();
        } else {
            $login_error = "Invalid email or password";
        }
    } catch (PDOException $e) {
        $login_error = "Database error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tech & Innovation Forum</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .landing-container {
      display: flex;
      min-height: 100vh;
      background: linear-gradient(135deg, #1a2a6c, #b21f1f, #1a2a6c);
    }
    
    .landing-left {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
      color: white;
      text-align: center;
      background: rgba(0, 0, 0, 0.7);
    }
    
    .landing-right {
      flex: 1;
      background: url('https://images.unsplash.com/photo-1533750349088-cd871a92f312?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center/cover;
      display: none;
    }
    
    .logo {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: #4fc3f7;
    }
    
    .tagline {
      font-size: 1.8rem;
      margin-bottom: 30px;
      max-width: 600px;
    }
    
    .features {
      text-align: left;
      max-width: 500px;
      margin: 30px 0;
    }
    
    .feature-item {
      display: flex;
      align-items: center;
      margin: 15px 0;
      font-size: 1.1rem;
    }
    
    .feature-icon {
      margin-right: 15px;
      font-size: 1.5rem;
      color: #4fc3f7;
    }
    
    @media (min-width: 900px) {
      .landing-right {
        display: block;
      }
    }
  </style>
</head>
<body>
  <div class="landing-container">
    <div class="landing-left">
      <div class="logo">Tech & Innovation Forum</div>
      <div class="tagline">Connect. Collaborate. Innovate.</div>
      
      <div class="features">
        <div class="feature-item">
          <span class="feature-icon">✓</span>
          <span>Join discussions on cutting-edge technologies</span>
        </div>
        <div class="feature-item">
          <span class="feature-icon">✓</span>
          <span>Connect with industry experts and enthusiasts</span>
        </div>
        <div class="feature-item">
          <span class="feature-icon">✓</span>
          <span>Share your knowledge and learn from others</span>
        </div>
        <div class="feature-item">
          <span class="feature-icon">✓</span>
          <span>Stay updated on the latest tech trends</span>
        </div>
      </div>
      
      <div class="login-form">
        <h2>Login to Your Account</h2>
        
        <?php if ($login_error): ?>
          <div class="error-message"><?= htmlspecialchars($login_error) ?></div>
        <?php endif; ?>
        
        <form method="POST" action="index.php">
          <div class="form-group">
            <input type="email" id="email" name="email" placeholder="Email address" required />
          </div>
          
          <div class="form-group">
            <input type="password" id="password" name="password" placeholder="Password" required />
          </div>
          
          <button type="submit" class="login-btn">Login</button>
        </form>
        
        <div class="signup-link">
          Don't have an account? <a href="register.php">Sign up now</a>
        </div>
      </div>
    </div>
    
    <div class="landing-right"></div>
  </div>

  <script src="script.js"></script>
</body>
</html>