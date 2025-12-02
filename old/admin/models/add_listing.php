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

if(isset($_POST['store_name'])) {
    $store_name = htmlspecialchars($_POST['store_name'], ENT_QUOTES, 'UTF-8');
    $description =$_POST['description'];
    $address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $open_time = htmlspecialchars($_POST['open_time'], ENT_QUOTES, 'UTF-8');
    $closing_time = htmlspecialchars($_POST['closing_time'], ENT_QUOTES, 'UTF-8');
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

    if(empty($store_name)) {
        echo "<span>Kindly provide store title</span>";
        exit();
    } 
    elseif(empty($address)) {
        echo "<span>Kindly provide store address</span>";
        exit();
    } 
    elseif(empty($username)) {
        echo "<span>Kindly provide store username</span>";
        exit();
    } 
    elseif (!preg_match("/^[A-Za-z_]+$/", $username)) {
        echo "The username is invalid. It must only contain letters and underscores, and no spaces.";
        exit();
    } 
    elseif(empty($email)) {
        echo "<span>Kindly provide store email</span>";
        exit();
    } 
    else if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Invalid email address.";
        exit();
        }
    elseif(empty($phone)) {
        echo "Kindly provide store phone";
        exit();
    } 
    elseif(isValidPhoneNumber($phone)){
        echo "The phone number is valid.";
        exit();
    }
    
    else {
        $select = "SELECT username FROM listings WHERE username = ? ";
        $stmt = $pdo->prepare($select);
        $stmt->execute([$username]);
        if($stmt->rowCount()==1){
            echo "<span class=''>".$username." already exist, kindly choose a different username.</span>";
            exit();
        }
        $upload_dir = "../../images/stores/";
        $img_url = "/images/stores/";
          $file_path = $url . $img_url;
        $uploadMultipleImagesResult = uploadMultipleImages($pdo, $data_id, $upload_dir, $file_path, $date);
        if ($uploadMultipleImagesResult === "All images uploaded successfully.") {
                $status = "published";
                    $store_url = $url . "/store/" . $username;

                    $query_sql = "INSERT INTO listings(store_name, address, store_id, username, email, phone, description, store_url, status, created_date, update_date, views, open_time, closing_time) VALUES(:store_name, :address, :store_id, :username, :email, :phone, :description, :store_url, :status, :created_date, :update_date, :views, :open_time, :closing_time)";
                    $query_stmt = $pdo->prepare($query_sql);
                    $query_stmt->execute([
                        'store_name' => $store_name,
                        'address' => $address,
                        'store_id' => $data_id,
                        'username' => $username,
                        'email' => $email,
                        'phone' => $phone,
                        'description' => $description,
                        'store_url' => $store_url,
                        'status' => $status,
                        'created_date' => $date,
                        'update_date' => $update_date,
                        'views' => $views,
                        'closing_time' => $closing_time,
                        'open_time' => $open_time,
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
