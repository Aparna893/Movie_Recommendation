<?php
include 'db.php';

$movie_id = $_GET['movie_id'] ?? null;

if (!$movie_id) {
    http_response_code(400);
    echo "Movie ID is required.";
    exit;
}

$sql = "SELECT r.review, u.username FROM reviews r
        JOIN users u ON r.user_id = u.id
        WHERE r.movie_id = ?
        ORDER BY r.created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];
while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

header('Content-Type: application/json');
echo json_encode($reviews);
?>
