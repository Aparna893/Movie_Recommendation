<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "❌ Please login to add a review.";
    exit;
}

$user_id = $_SESSION['user_id'];
$movie_id = $_POST['movie_id'] ?? '';
$rating = $_POST['rating'] ?? '';
$review = $_POST['review'] ?? '';

if ($movie_id && $rating) {
    $stmt = $conn->prepare("INSERT INTO reviews (user_id, movie_id, rating, review) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $user_id, $movie_id, $rating, $review);
    if ($stmt->execute()) {
        echo "✅ Review added successfully!";
    } else {
        echo "⚠️ Failed to add review.";
    }
} else {
    echo "❌ Missing movie or rating.";
}
?>
