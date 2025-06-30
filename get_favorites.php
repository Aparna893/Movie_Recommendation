<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo "You must be logged in.";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT m.* FROM movies m
        JOIN favorites f ON m.id = f.movie_id
        WHERE f.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$favorites = [];
while ($row = $result->fetch_assoc()) {
    $favorites[] = $row;
}

header('Content-Type: application/json');
echo json_encode($favorites);
?>
