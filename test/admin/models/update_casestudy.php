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

if (isset($_POST['data_id'])) {
    $data_id = isset($_POST['data_id']) ? $_POST['data_id'] : null;
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $client = isset($_POST['client']) ? $_POST['client'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $tags = isset($_POST['tags']) ? $_POST['tags'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
    try {
        date_default_timezone_set($timezone);
    } catch (Exception $e) {
        date_default_timezone_set("UTC");
    }
    $date = date('Y/m/d h:i:s a', time());

    try {
            $query = "UPDATE case_study 
            SET title = :title, client = :client, status = :status, tag = :tag, 
                start_date = :start_date, body = :body, update_date = :update_date, end_date = :end_date
            WHERE data_id = :data_id";

  $query_stmt = $pdo->prepare($query);
  $query_stmt->execute([
      'title' => $title,
      'client' => $client,
      'status' => $status,
      'tag' => $tags,
      'start_date' => $start_date,
      'body' => $description,
      'end_date' => $end_date,
      'update_date' => $date,
      'data_id' => $data_id,
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
