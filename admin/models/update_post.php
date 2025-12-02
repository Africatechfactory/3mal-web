<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include "../../includes/session.php";
include "../../database/config.php";
include "../../includes/functions.php";

if (isset($_POST['blog_id'])) {
    $blog_id = isset($_POST['blog_id']) ? $_POST['blog_id'] : null;
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
    $image_caption = isset($_POST['image_caption']) ? $_POST['image_caption'] : '';
    $body = isset($_POST['post']) ? $_POST['post'] : '';
    $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
    try {
        date_default_timezone_set($timezone);
    } catch (Exception $e) {
        date_default_timezone_set("UTC");
    }
    $date = date('Y/m/d h:i:s a', time());

    try {
        $query = "UPDATE blog 
                  SET title = :title, author = :author, category = :category, keywords = :keywords, 
                      image_caption = :image_caption, body = :body, update_date = :update_date
                  WHERE blog_id = :blog_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'title' => $title,
            'author' => $author,
            'category' => $category,
            'keywords' => $keywords,
            'image_caption' => $image_caption,
            'body' => $body,
            'update_date' => $date,
            'blog_id' => $blog_id,
        ]);

        if ($query_stmt) {
            echo 'successful';
        } else {
            echo 'error';
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
