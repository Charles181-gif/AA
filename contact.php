<?php
require_once 'config.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate inputs
    if (empty($subject) || empty($message)) {
        $error = "All fields are required";
    }else {
        try {
            // Save to database (create a contacts table first)
            $stmt = $pdo->prepare("
                INSERT INTO contacts (subject, message, user_id, created_at)
                VALUES , (?, ?, ?, NOW())
            ");
            
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            $stmt->execute([$subject, $message, $user_id]);
            
            $success = "Thank you for your message! We'll get back to you soon.";
            
            // Here you would typically also send an email notification            
        } catch (PDOException $e) {
            $error = "Please check your internet connection and try again later";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - GCTU Connect</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        .contact-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }
        
        .contact-card {
            background: #f8f9ff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        
        .contact-card svg {
            width: 40px;
            height: 40px;
            margin-bottom: 15px;
            color: var(--primary);
        }
        
        .contact-form {
            margin-top: 40px;
        }
        
        @media (max-width: 768px) {
            .contact-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
  <?php include 'header.php'; ?>
    <main>
        <section class="hero" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80')">
            <h1>Contact Us</h1>
            <p>Have questions or feedback? We'd love to hear from you!</p>
        </section>
        
        <div class="contact-container">
            <?php if ($error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="success-message"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            
            <div class="contact-info">
                <div class="contact-card">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                        <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                    </svg>
                    <h3>Email Us</h3>
                    <p>https://site.gctu.edu.gh/</p>
                </div>
                
                <div class="contact-card">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                    </svg>
                    <h3>Call Us</h3>
                    <p>059-867-0195</p>
                </div>
                
                <div class="contact-card">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                    <h3>Visit Us</h3>
                    <p>GCTU Tesano Accra <br>(Nsawam Road)</p>
                </div>
            </div>
            
            <div class="contact-form">
                <h2 class="section-title">Send Us a Message</h2>
                <form method="POST" action="contact.php">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required
                          value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
        </div>
    </main>
    <script>
        // Simple client-side validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const message = document.getElementById('message').value;
            if (message.length < 10) {
                e.preventDefault();
                alert('Please write a more detailed message (at least 10 characters)');
            }
        });
    </script>
    <?php include 'footer.php'; ?>

</body>
</html>