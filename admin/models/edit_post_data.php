<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include "../../includes/session.php";
include "../../database/config.php";
include "../../includes/functions.php";

if (isset($_GET['blog_id'])) {
    try {
        $blog_id = $_GET['blog_id'];
        $query = "SELECT b.blog_id, b.title, b.created_date, b.author, b.category, b.keywords, b.image_caption, b.body, i.image_url 
                  FROM blog b 
                  INNER JOIN images i ON b.blog_id = i.data_id 
                  WHERE b.blog_id = ?";
        $stmt = $pdo->prepare($query);
      //  $stmt->bindParam(':blog_id', $blog_id, PDO::PARAM_INT);
        $stmt->execute([$blog_id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($post) {
            $post['title'] = htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
            $post['author'] = htmlspecialchars($post['author'], ENT_QUOTES, 'UTF-8');
            $post['category'] = htmlspecialchars($post['category'], ENT_QUOTES, 'UTF-8');
            $post['keywords'] = htmlspecialchars($post['keywords'], ENT_QUOTES, 'UTF-8');
            $post['image_caption'] = htmlspecialchars($post['image_caption'], ENT_QUOTES, 'UTF-8');
            $post['image_url'] = htmlspecialchars($post['image_url'], ENT_QUOTES, 'UTF-8');
            $post['body'] = $post['body'];
            // $post['created_date'] = (new DateTime($post['created_date']))->format('j M, Y');

            header('Content-Type: application/json');
            echo json_encode($post);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No post found']);
        }
    }
    catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
   
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing blog_id parameter']);
}

?>