<?php
// index.php (landing page)
require_once __DIR__ . '/config.php'; 

// Redirect logged-in users to forum
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

isset($_SESSION['redirection_from_registration']) ? $just_registered = true : $just_registered = false;

$login_error = '';
$success = "Registration successful! You can now login.";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$login, $login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: forum.php");
            exit();
        } else {
            $login_error = "Invalid username/email or password";
        }
    } catch (PDOException $e) {
        $login_error = "Database error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tech & Innovation Forum</title>
  <link rel="stylesheet" href="style1.css" />
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
      <div class="logo">GCTU Connect</div>
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

        <?php if (isset($_SESSION['redirection_from_registration']) && $_SESSION['redirection_from_registration'] = true): ?>
          <div class="success-message"><?= htmlspecialchars($success) ?></div>
        <?php endif; unset($_SESSION['redirection_from_registration']);?>
        
        <form method="POST" action="index.php">
          
        <div class="form-group">
            <input type="text" id="login" name="login" placeholder="Username or Email" required />
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