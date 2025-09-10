<?php
// forum.php
require_once 'config.php';

// Handle new thread creation
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    
    if (!empty($title) && !empty($content)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO threads (title, content, user_id) VALUES (?, ?, ?)");
            $stmt->execute([$title, $content, $_SESSION['user_id']]);
            header("Location: forum.php");
            exit();
        } catch (PDOException $e) {
            $thread_error = "Error creating thread: " . $e->getMessage();
        }
    } else {
        $thread_error = "Title and content are required";
    }
}

// Get all threads with author usernames
try {
    $stmt = $pdo->query("
        SELECT t.id, t.title, t.created_at, u.username 
        FROM threads t
        JOIN users u ON t.user_id = u.id
        ORDER BY t.created_at DESC
    ");
    $threads = $stmt->fetchAll();
} catch (PDOException $e) {
    $thread_error = "Error loading threads: " . $e->getMessage();
    $threads = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GCTU Connect</title>
  <link rel="stylesheet" href="style1.css" />
</head>
<body>
  <?php include 'header.php'; ?>
  
<main>
    <article class="forum-section">
        <h1 class="section-title">Community Forum</h1>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="thread-form">
                <h2>Start a New Discussion</h2>
                <?php if (isset($thread_error)): ?>
                    <div class="error-message" role="alert" aria-live="assertive">
                        <?= htmlspecialchars($thread_error) ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="forum.php">
                    <div class="form-group">
                        <input type="text" id="title" name="title" placeholder="Thread title" required maxlength="255">
                    </div>
                    
                    <div class="form-group">
                        <textarea id="content" name="content" rows="6" placeholder="What would you like to discuss?" required></textarea>
                    </div>
                    
                    <button type="submit">Create Thread</button>
                </form>
            </div>
        <?php else: ?>
            <div style="background: #f8f9ff; padding: 20px; border-radius: 8px; text-align: center; margin-bottom: 30px;">
                <p>Please <a href="index.php">login</a> or <a href="register.php">register</a> to create new discussions.</p>
            </div>
        <?php endif; ?>
        
        <h2 style="margin: 40px 0 20px;">Recent Discussions (<?= count($threads) ?>)</h2>
        
        <?php if (count($threads) > 0): ?>
            <table class="forum-table">
                <thead>
                    <tr>
                        <th>Topic</th>
                        <th>Author</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($threads as $thread): ?>
                        <tr>
                            <td>
                                <a href="thread.php?id=<?= htmlspecialchars($thread['id']) ?>" style="font-weight: 600;">
                                    <?= htmlspecialchars($thread['title']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($thread['username']) ?></td>
                            <td><?= date('F j, Y', strtotime($thread['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div style="text-align: center; padding: 40px; background: #f8f9ff; border-radius: 8px;">
                <p style="font-size: 1.1rem;">No discussions yet. Be the first to start a conversation!</p>
            </div>
        <?php endif; ?>
    </article>
</main>
<?php include 'footer.php'; ?>
</body>
</html>