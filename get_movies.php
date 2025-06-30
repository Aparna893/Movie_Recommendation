<?php
include 'db.php';

$genre = $_GET['genre'] ?? '';
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? '';

$sql = "SELECT * FROM movies WHERE 1";

if (!empty($genre)) {
    $genre = $conn->real_escape_string($genre);
    $sql .= " AND genre = '$genre'";
}

if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " AND title LIKE '%$search%'";
}

if ($sort === 'year_asc') {
    $sql .= " ORDER BY release_year ASC";
} elseif ($sort === 'year_desc') {
    $sql .= " ORDER BY release_year DESC";
} elseif ($sort === 'rating_desc') {
    $sql = "SELECT m.*, AVG(r.rating) as avg_rating 
            FROM movies m 
            LEFT JOIN reviews r ON m.id = r.movie_id 
            GROUP BY m.id 
            ORDER BY avg_rating DESC";
}

$result = $conn->query($sql);

$movies = [];
while ($row = $result->fetch_assoc()) {
    $movies[] = $row;
}

header('Content-Type: application/json');
echo json_encode($movies);
?>
