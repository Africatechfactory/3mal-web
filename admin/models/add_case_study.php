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

if (isset($_POST['title'])) {
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $description = $_POST['description'];
    $client = htmlspecialchars($_POST['client'], ENT_QUOTES, 'UTF-8');
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $tags = htmlspecialchars($_POST['tags'], ENT_QUOTES, 'UTF-8');
    $start_time = htmlspecialchars($_POST['start_date'], ENT_QUOTES, 'UTF-8');
    $end_time = htmlspecialchars($_POST['end_date'], ENT_QUOTES, 'UTF-8');
    $status = htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');
    $data_id = uniqid();
    $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
    $update_date = '';
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
    

    try {
        date_default_timezone_set($timezone);
    } catch (Exception $e) {
        date_default_timezone_set("UTC");
    }

    $date = date('Y/m/d h:i:s a', time());

    if (empty($title)) {
        echo "<span>Kindly provide project title.</span>";
        exit();
    } elseif (empty($client)) {
        echo "<span>Kindly provide the client.</span>";
        exit();
    } elseif (empty($start_time)) {
        echo "<span>Kindly provide project start time</span>";
        exit();
    } elseif (empty($tags)) {
        echo "<span>Kindly provide project tag(s)</span>";
        exit();
    } elseif (empty($description)) {
        echo "Kindly provide a brief description of the project.";
        exit();
    } else {
        $upload_dir = "../../images/case-study/";
        $img_url = "/images/case-study/";
        $file_path = $url . $img_url;

        // Call the uploadMultipleImages function
        $uploadMultipleImagesResult = uploadMultipleImages($pdo, $data_id, $upload_dir, $file_path, $date);

        if ($uploadMultipleImagesResult === "All images uploaded successfully.") {
            $explode_title = str_replace(" ", "-", $title);
            $study_url = $url . "/case_study/" . $data_id . "_" . $explode_title;
            $pub_status = "published";
            $query_sql = "INSERT INTO case_study(title, body, data_id, client, start_date, end_date, tag, study_url, status, created_date, update_date, pub_status, category) VALUES(:title, :body, :data_id, :client, :start_date, :end_date, :tag, :study_url, :status, :created_date, :update_date, :pub_status, :category)";
            $query_stmt = $pdo->prepare($query_sql);
            $query_stmt->execute([
                'title' => $title,
                'body' => $description,
                'data_id' => $data_id,
                'client' => $client,
                'start_date' => $start_time,
                'end_date' => $end_time,
                'tag' => $tags,
                'study_url' => $study_url,
                'status' => $status,
                'created_date' => $date,
                'update_date' => $update_date,
                'pub_status' => $pub_status,
                'category' => $category
            ]);

            if ($query_stmt) {
                echo 'successful';
            } else {
                echo 'error';
            }
        } else {
            echo "Error uploading image(s): " . $uploadMultipleImagesResult;
        }
    }
}
?>