<?php
include "../database/config.php";
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
if(isset($_POST['name'], $_POST['news_id'], $_POST['email'], $_POST['response'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $news_id = htmlspecialchars($_POST['news_id'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $response =  $_POST['response'];
    $comment_id  = uniqid();  
    $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
    try {
        date_default_timezone_set($timezone);
    } catch (Exception $e) {
        date_default_timezone_set("UTC");
    }
    $date = date('Y/m/d h:i:s a', time());

    if(empty($name)) {
        echo "<span>Kindly provide your name.</span>";
    } elseif(empty($email)) {
        echo "<span class=''>Kindly provide your email.</span>";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span class=''>Kindly provide a valid email address.</span>";
    } elseif(empty($response)) {
        echo "<span>Kindly provide a response.</span>";
    } else {
        try {
            $sql = "INSERT INTO comments(comment_id, news_id, name, email, text, date) VALUES(:comment_id, :news_id, :name, :email, :text, :date)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'comment_id' => $comment_id,
                'news_id' => $news_id,
                'name' => $name,
                'email' => $email,
                'text' => $response,
                'date' => $date
            ]);

            if($stmt->rowCount() > 0) {
                echo "successful";
            } else {
                echo "error";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>