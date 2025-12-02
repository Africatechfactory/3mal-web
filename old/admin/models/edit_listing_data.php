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

if (isset($_GET['store_id'])) {
    try {
        $store_id = $_GET['store_id'];
        $query = "SELECT l.store_id, l.store_name, l.username, l.email, l.phone, l.address, l.open_time, l.closing_time, l.description,  i.image_url 
                  FROM listings l 
                  INNER JOIN images i ON l.store_id = i.data_id 
                  WHERE l.store_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$store_id]);
        $listing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($listing) {
            $listing['store_name'] = htmlspecialchars($listing['store_name'], ENT_QUOTES, 'UTF-8');
            $listing['username'] = htmlspecialchars($listing['username'], ENT_QUOTES, 'UTF-8');
            $listing['email'] = htmlspecialchars($listing['email'], ENT_QUOTES, 'UTF-8');
            $listing['phone'] = htmlspecialchars($listing['phone'], ENT_QUOTES, 'UTF-8');
            $listing['address'] = htmlspecialchars($listing['address'], ENT_QUOTES, 'UTF-8');
            $listing['image_url'] = htmlspecialchars($listing['image_url'], ENT_QUOTES, 'UTF-8');
            $listing['description'] = $listing['description'];
            $listing['open_time'] = $listing['open_time'];
            $listing['closing_time'] = $listing['closing_time'];

            header('Content-Type: application/json');
            echo json_encode($listing);
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
    echo json_encode(['error' => 'Missing store_id parameter']);
}
?>