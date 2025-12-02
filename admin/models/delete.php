<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST, DELETE"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include "../../includes/session.php";
include "../../database/config.php";
include "../../includes/functions.php";

if(isset($_GET['delete_post'])) {
     $blog_id = $_GET['delete_post'];
    try{
    $sql = "DELETE FROM blog WHERE blog_id = :blog_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'blog_id' => $blog_id
    ]);
    $postDeleted = $stmt->rowCount();
    
    $sql = "DELETE FROM images WHERE data_id = :data_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'data_id' => $blog_id
    ]);
    $imagesDeleted = $stmt->rowCount();
    
    if($postDeleted && $imagesDeleted){
       echo "successful";
    }
    else {
        echo "error";
    } 
    }
    catch (PDOException $e) {
         $pdo->rollBack();
        echo  $e->getMessage();
    }
} 

else if (isset($_GET['delete_listing'])) {
    $store_id = $_GET['delete_listing'];

    try {
    $sql = "DELETE FROM listings WHERE store_id = :store_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'store_id' => $store_id
    ]);
    $deletedRow = $stmt->rowCount();
    
    $sql = "DELETE FROM images WHERE data_id = :data_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'data_id' => $store_id
    ]);
    $imagesDeleted = $stmt->rowCount();
    
    if($deletedRow && $imagesDeleted){
       echo "successful";
    }
    else {
        echo "error";
    } 
    } catch (PDOException $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['delete_casestudy'])) {
    $data_id = $_GET['delete_casestudy'];

    try {
    $sql = "DELETE FROM case_study WHERE data_id = :data_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'data_id' => $data_id
    ]);
    $deletedRow = $stmt->rowCount();
    
    $sql = "DELETE FROM images WHERE data_id = :data_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'data_id' => $data_id
    ]);
    $imagesDeleted = $stmt->rowCount();
    
    if($deletedRow && $imagesDeleted){
       echo "successful";
    }
    else {
        echo "error";
    }
    } catch (PDOException $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['delete_event'])) {
    $data_id = $_GET['delete_event'];

    try {
    $sql = "DELETE FROM events WHERE event_id = :event_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'event_id' => $data_id
    ]);
    $deletedRow = $stmt->rowCount();
    
    $sql = "DELETE FROM images WHERE data_id = :data_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'data_id' => $data_id
    ]);
    $imagesDeleted = $stmt->rowCount();
    
    if($deletedRow && $imagesDeleted){
       echo "successful";
    }
    else {
        echo "error";
    }
    } catch (PDOException $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 
//else {
//     http_response_code(400);
//     echo json_encode(['error' => 'Missing parameter']);
// }
?>
