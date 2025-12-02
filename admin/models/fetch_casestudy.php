<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$rootPath = dirname(__DIR__, 2);
include $rootPath . "/includes/session.php";
include $rootPath . "/database/config.php";
include $rootPath . "/includes/functions.php";

function fetchCasestudy($status) {
    global $pdo;

    try {
        $query = "SELECT 
                    c.data_id, 
                    c.title, 
                    c.created_date, 
                    MIN(i.image_url) AS image_url
                  FROM 
                    case_study c
                  LEFT JOIN 
                    images i ON c.data_id = i.data_id
                  WHERE 
                    c.pub_status = ?
                  GROUP BY 
                    c.data_id, 
                    c.title, 
                    c.created_date
                  ORDER BY c.created_date DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$status]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($posts) {
            $data = [];
            foreach ($posts as $post) {
                $formattedTitle = htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
                $imageUrl = $post['image_url'];
                $header_title = strip_cleanUrl($post['title']);
                $rawDate = $post['created_date'];
                $dateObj = new DateTime($rawDate);
                $formattedDate = $dateObj->format('j M, Y');

                $array = [
                    'data_id' => $post['data_id'],
                    'title' => $formattedTitle,
                    'image_url' => $imageUrl,
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
    if (isset($_GET['fetch_all_casestudy'])) {
        $status = htmlspecialchars($_GET['fetch_all_casestudy'], ENT_QUOTES, 'UTF-8');
        switch ($status) {
            case 'published':
            case 'archived':
            case 'trashed':
                fetchCasestudy($status);
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
