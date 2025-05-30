<?php
// thread.php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: forum.php");
    exit();
}

$threadId = (int)$_GET['id'];

try {
    // Get thread with author info
    $stmt = $pdo->prepare("
        SELECT t.*, u.username 
        FROM threads t
        JOIN users u ON t.author = u.id
        WHERE t.id = ?
    ");
    $stmt->execute([$threadId]);
    $thread = $stmt->fetch();
    
    if (!$thread) {
        header("Location: forum.php");
        exit();
    }
    
    // Get replies with author info
    $stmt = $pdo->prepare("
        SELECT r.*, u.username 
        FROM replies r
        JOIN users u ON r.user_id = u.id
        WHERE r.thread_id = ?
        ORDER BY r.created_at ASC
    ");
    $stmt->execute([$threadId]);
    $replies = $stmt->fetchAll();
    
    // Handle new reply submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
        $content = trim($_POST['content']);
        
        if (!empty($content)) {
            $stmt = $pdo->prepare("
                INSERT INTO replies (thread_id, user_id, content)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([$threadId, $_SESSION['user_id'], $content]);
            
            // Refresh to show new reply
            header("Location: thread.php?id=$threadId");
            exit();
        }
    }
    
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($thread['title']) ?> - Tech Forum</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main class="thread-container">
        <article class="thread">
            <h1><?= htmlspecialchars($thread['title']) ?></h1>
            <div class="thread-meta">
                Posted by <?= htmlspecialchars($thread['username']) ?> 
                on <?= date('M j, Y g:i a', strtotime($thread['created_at'])) ?>
            </div>
            <div class="thread-content">
                <?= nl2br(htmlspecialchars($thread['content'])) ?>
            </div>
        </article>
        
        <section class="replies">
            <h2>Replies (<?= count($replies) ?>)</h2>
            
            <?php if (empty($replies)): ?>
                <p>No replies yet. Be the first to respond!</p>
            <?php else: ?>
                <?php foreach ($replies as $reply): ?>
                    <div class="reply">
                        <div class="reply-meta">
                            <?= htmlspecialchars($reply['username']) ?> 
                            on <?= date('M j, Y g:i a', strtotime($reply['created_at'])) ?>
                        </div>
                        <div class="reply-content">
                            <?= nl2br(htmlspecialchars($reply['content'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <form class="reply-form" method="POST">
                <h3>Post a Reply</h3>
                <textarea name="content" rows="5" required></textarea>
                <button type="submit">Submit Reply</button>
            </form>
        <?php else: ?>
            <p><a href="index.php">Login</a> to post a reply.</p>
        <?php endif; ?>
    </main>
    
    <?php include 'footer.php'; ?>
</body>
</html>