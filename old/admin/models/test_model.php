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

$query = "SELECT * FROM blog WHERE status = ?";
$status = 'trashed';
$stmt = $pdo->prepare($query);
$stmt->execute([$status]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($posts);
