<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
include "../database/config.php";
if (isset($_POST['reply_name'])) {
    $name = htmlspecialchars($_POST['reply_name'], ENT_QUOTES, 'UTF-8');
    $news_id = htmlspecialchars($_POST['news_id'], ENT_QUOTES, 'UTF-8');
    $reply_to = htmlspecialchars($_POST['reply_to'], ENT_QUOTES, 'UTF-8');
    $response = $_POST['text'];
    $comment_id = htmlspecialchars($_POST['comment_id'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['reply_email'], ENT_QUOTES, 'UTF-8');
    $reply_id = uniqid();
     $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
    try {
        date_default_timezone_set($timezone);
    } catch (Exception $e) {
        date_default_timezone_set("UTC");
    }
    $date = date('Y/m/d h:i:s a', time());

    if (empty($name)) {
        echo "<span>kindly provide your name.</span>";
    } elseif (empty($response)) {
        echo "<span>kindly provide a response.</span>";
    } elseif ($email === false) {
        echo "<span>kindly provide a valid email address.</span>";
    } else {
        try {
            $sql = "INSERT INTO reply (reply_id, comment_id, news_id, name, email, reply_to, text, date) VALUES (:reply_id, :comment_id, :news_id, :name, :email, :reply_to, :text, :date)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'reply_id' => $reply_id,
                'comment_id' => $comment_id,
                'news_id' => $news_id,
                'name' => $name,
                'email' => $email,
                'reply_to' => $reply_to,
                'text' => $response,
                'date' => $date
            ]);

            if ($stmt) {
                echo "successful";
            } else {
                echo "error";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
} 
?>