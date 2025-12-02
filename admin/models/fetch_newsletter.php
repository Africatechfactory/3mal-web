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

try {
    $stmt = $pdo->prepare("SELECT id, email, created_date FROM newletter ORDER BY id DESC");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        $data = [];
        foreach ($rows as $row) {
            $data[] = [
                'id' => $row['id'],
                'email' => htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'),
                'created_date' => $row['created_date'],
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'No newsletter subscriptions found']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
