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

if (isset($_GET['data_id'])) {
    try {
        $data_id = $_GET['data_id'];
        $query = "SELECT c.data_id, c.title, c.client, c.status, c.start_date, c.end_date, c.body, c.tag,  i.image_url 
                  FROM case_study c 
                  INNER JOIN images i ON c.data_id = i.data_id 
                  WHERE c.data_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$data_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $data['title'] = htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8');
            $data['client'] = htmlspecialchars($data['client'], ENT_QUOTES, 'UTF-8');
            $data['status'] = htmlspecialchars($data['status'], ENT_QUOTES, 'UTF-8');
            $data['tag'] = htmlspecialchars($data['tag'], ENT_QUOTES, 'UTF-8');
            $data['start_date'] = $data['start_date'];
            $data['image_url'] = htmlspecialchars($data['image_url'], ENT_QUOTES, 'UTF-8');
            $data['body'] = $data['body'];
            $data['end_date'] = $data['end_date'];

            header('Content-Type: application/json');
            echo json_encode($data);
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
    echo json_encode(['error' => 'Missing  parameter']);
}
?>