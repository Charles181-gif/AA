<?php
require_once 'config.php';

// Redirect logged-in users
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif (strlen($password) < 10) {
        $error = "Password must be at least 10 characters";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        try {
            // Check if email exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $error = "Email already registered";
            } else {
                // Check if username exists
                $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
                $stmt->execute([$username]);
                
                if ($stmt->rowCount() > 0) {
                    $error = "Username already taken";
                } else {
                    // Hash password and create account
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                    $stmt->execute([$username, $email, $hashedPassword]);
                    
                    
                    $_SESSION['redirection_from_registration'] = true;
                    
                    header("Location: index.php");

                }
            }
        } catch (PDOException $e) {
            $error = "Check Your Internet Connection" . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - GCTU Connect</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        .register-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .register-container h1 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 30px;
        }
        
        .password-hint {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: -10px;
            margin-bottom: 15px;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    
    
    <main>
        <div class="register-container">
            <h1>Create an Account</h1>
            
            <?php if ($error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required 
                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required 
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <p class="password-hint">Minimum 8 characters</p>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="btn">Register</button>
            </form>
            
            <div class="login-link">
                Already have an account? <a href="index.php">Login here</a>
            </div>
        </div>
    </main>
    
   
    
    <script>
        // Client-side password validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('confirm_password').value;
            
            if (password !== confirm) {
                e.preventDefault();
                alert('Passwords do not match');
            }
            
            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters');
            }
        });
    </script>
</body>
</html>