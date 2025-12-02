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

if (isset($_POST['store_id'])) {
    $store_id = isset($_POST['store_id']) ? $_POST['store_id'] : null;
    $store_name = isset($_POST['store_name']) ? $_POST['store_name'] : '';
  //  $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $open_time = isset($_POST['open_time']) ? $_POST['open_time'] : '';
    $closing_time = isset($_POST['closing_time']) ? $_POST['closing_time'] : '';
    $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
    try {
        date_default_timezone_set($timezone);
    } catch (Exception $e) {
        date_default_timezone_set("UTC");
    }
    $date = date('Y/m/d h:i:s a', time());

    try {
        // $select = "SELECT username FROM listings WHERE username = ? ";
        // $stmt = $pdo->prepare($select);
        // $stmt->execute([$username]);
        // if($stmt->rowCount()==1){
        //     echo "<span class=''>".$username." already exist, kindly choose a different username.</span>";
        //     exit();
        // }
        // else {
            $query = "
            UPDATE listings 
            SET 
            store_name = :store_name, 
            email = :email, 
            phone = :phone, 
            address = :address, 
            description = :description, 
            update_date = :update_date, 
            closing_time = :closing_time, 
            open_time = :open_time
            WHERE store_id = :store_id";

  $query_stmt = $pdo->prepare($query);
  $query_stmt->execute([
      'store_name' => $store_name,
     // 'username' => $username,
      'email' => $email,
      'address' => $address,
      'phone' => $phone,
      'description' => $description,
      'closing_time' => $closing_time,
      'open_time' => $open_time,
      'update_date' => $date,
      'store_id' => $store_id,
  ]);

  if ($query_stmt) {
    echo 'successful';
} else {
    echo 'error';
}
      //  }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
