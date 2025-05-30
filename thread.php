<?php
// thread.php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: forum.php");
    exit();
}

$threadId = (int)$_GET['id'];

try {
    // Get thread
    $stmt = $pdo->prepare("SELECT * FROM threads WHERE id = ?");
    $stmt->execute([$threadId]);
    $thread = $stmt->fetch();
    
    if (!$thread) {
        header("Location: forum.php");
        exit();
    }
    
    // Get replies (you'll need to create a replies table)
    // $replies = $pdo->prepare("SELECT * FROM replies WHERE thread_id = ? ORDER BY created_at");
    // $replies->execute([$threadId]);
    // $replies = $replies->fetchAll();
    
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Add HTML to display the thread and replies
// Include form to post replies if logged in