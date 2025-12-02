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

if(isset($_POST['title'])) {
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $description =$_POST['description'];
    $client = htmlspecialchars($_POST['client'], ENT_QUOTES, 'UTF-8');
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $location = htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8');
    $event_date = htmlspecialchars($_POST['event_date'], ENT_QUOTES, 'UTF-8');
    $status = htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');
    $data_id  = uniqid();
    $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
    $update_date = '';
    $views = 0;
    try {
        date_default_timezone_set($timezone);
    } catch (Exception $e) {
        date_default_timezone_set("UTC");
    }
    $date = date('Y/m/d h:i:s a', time());
    if(empty($title)) {
        echo "<span>Kindly provide project title.</span>";
        exit();
    } elseif(empty($client)) {
        echo "<span>Kindly provide the client.</span>";
        exit();
    } elseif(empty($event_date)) {
        echo "<span>Kindly provide event date</span>";
        exit();
    } elseif(empty($description)) {
        echo "Kindly provide a brief description of the project.";
        exit();
    } else {
        $upload_dir = "../../images/events/";
        $img_url = "/images/events/";
        $count = count($_FILES['images']['name']);
         $file_path = $url . $img_url;

        // Call the uploadMultipleImages function
        $uploadMultipleImagesResult = uploadMultipleImages($pdo, $data_id, $upload_dir, $file_path, $date);

        if ($uploadMultipleImagesResult === "All images uploaded successfully.") {
              $explode_title = str_replace(" ", "-", $title);
                    $event_url = $url . "/event/" . $data_id . "_" . $explode_title;

                    $query_sql = "INSERT INTO events(title, body, event_id, client, event_date, location,  event_url, status, created_date, update_date, views) VALUES(:title, :body, :event_id, :client, :event_date, :location, :event_url, :status, :created_date, :update_date, :views)";
                    $query_stmt = $pdo->prepare($query_sql);
                    $query_stmt->execute([
                        'title' => $title,
                        'body' => $description,
                        'event_id' => $data_id,
                        'client' => $client,
                        'event_date' => $event_date,
                        'location' => $location,
                        'event_url' => $event_url,
                        'status' => $status,
                        'created_date' => $date,
                        'update_date' => $update_date,
                        'views' => $views,
                    ]);
                    if ($query_stmt) {
                        echo 'successful';
                    } else {
                        echo 'error';
                    }
        }
        else {
            echo "Error uploading images";
        }
      
    }
}
?>
