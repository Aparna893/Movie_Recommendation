<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo "You must be logged in.";
    exit;
}

$user_id = $_SESSION['user_id'];
$movie_id = $_POST['movie_id'] ?? '';

if (!$movie_id) {
    http_response_code(400);
    echo "Missing movie ID.";
    exit;
}

$stmt = $conn->prepare("INSERT IGNORE INTO favorites (user_id, movie_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $movie_id);

if ($stmt->execute()) {
    echo "Added to favorites!";
} else {
    echo "Failed to add favorite.";
}
?>
