<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../database/config.php";

if (isset($_POST['news_id'])) {
    $news_id = $_POST['news_id'];
    
    try {
        $sql = "SELECT COUNT(*) FROM comments WHERE news_id = :news_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['news_id' => $news_id]);
        $rowcount = $stmt->fetchColumn();
        echo "(" . $rowcount . ")";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
