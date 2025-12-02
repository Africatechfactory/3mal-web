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

function fetchEvents($status) {
    global $pdo;

    try {
        $query = "SELECT 
                    c.event_id, 
                    c.title, 
                    c.created_date, 
                    MIN(i.image_url) as image_url
                    FROM 
                    events c
                    LEFT JOIN 
                    images i ON c.event_id = i.data_id
                    WHERE 
                    c.pub_status = ?
                    GROUP BY 
                    c.event_id, 
                    c.title, 
                    c.created_date ORDER BY c.id DESC";
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
                    'event_id' => $post['event_id'],
                    'title' => $formattedTitle,
                    'image_url' => htmlspecialchars($post['image_url'], ENT_QUOTES, 'UTF-8'),
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
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}

try {
    if (isset($_GET['fetch_all_event'])) {
        $status = htmlspecialchars($_GET['fetch_all_event'], ENT_QUOTES, 'UTF-8');
        switch ($status) {
            case 'published':
            case 'archived':
            case 'trashed':
                fetchEvents($status);
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