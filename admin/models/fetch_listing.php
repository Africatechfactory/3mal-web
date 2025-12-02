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

function fetchListing($status) {
    global $pdo;
    $query = "SELECT l.store_id, l.store_name, l.created_date, i.image_url
              FROM listings l
              INNER JOIN images i ON l.store_id = i.data_id
              WHERE l.status = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$status]);
    $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($listings) {
        $data = [];
        foreach ($listings as $listing) {
            $formattedTitle = htmlspecialchars($listing['store_name'], ENT_QUOTES, 'UTF-8');
            $header_title = strip_cleanUrl($listing['store_name']);
            $rawDate = $listing['created_date'];
            $dateObj = new DateTime($rawDate);
            $formattedDate = $dateObj->format('j M, Y');

            $array = [
                'store_id' => $listing['store_id'],
                'store_name' => $formattedTitle,
                'image_url' => $listing['image_url'],
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
    if (isset($_GET['fetch_all_listing'])) {
        switch ($_GET['fetch_all_listing']) {
            case 'published':
            case 'archived':
            case 'trashed':
                fetchListing($_GET['fetch_all_listing']);
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