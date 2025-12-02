<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../../includes/session.php";
include "../../database/config.php";
include "../../includes/functions.php";

function fetchPosts($status) {
    global $pdo;
    $query = "SELECT b.blog_id, b.title, b.created_date, i.image_url
              FROM blog b
              INNER JOIN images i ON b.blog_id = i.data_id
              WHERE b.status = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$status]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if ($posts) {
    $data = [];
    foreach ($posts as $post) {
        $formattedTitle = htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
        $header_title = strip_cleanUrl($post['title']);
        $rawDate = $post['created_date'];
        $dateObj = new DateTime($rawDate);
        $formattedDate = $dateObj->format('j M, Y');

        $array = [
            'blog_id' => $post['blog_id'],
            'title' => $formattedTitle,
            'image_url' => $post['image_url'],
            'created_date' => $formattedDate,
            'formated_title' => $header_title
        ];
        $data[] = $array;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'No posts found']);
}

}

try {
    if (isset($_GET['fetch_all_post'])) {
        switch ($_GET['fetch_all_post']) {
            case 'published':
            case 'draft':
            case 'trashed':
                fetchPosts($_GET['fetch_all_post']);
                break;
            default:
                http_response_code(400);
                echo json_encode(['error' => 'Invalid request']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing parameter']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
