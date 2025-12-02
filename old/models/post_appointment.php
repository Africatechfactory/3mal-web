<?php
require_once "../database/config.php";

if(isset($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['event_type'], $_POST['event_date'], $_POST['start_time'], $_POST['end_time'], $_POST['venue'], $_POST['message'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $event_type = htmlspecialchars($_POST['event_type'], ENT_QUOTES, 'UTF-8');
    $event_date = htmlspecialchars($_POST['event_date'], ENT_QUOTES, 'UTF-8');
    $start_time = htmlspecialchars($_POST['start_time'], ENT_QUOTES, 'UTF-8');
    $end_time = htmlspecialchars($_POST['end_time'], ENT_QUOTES, 'UTF-8');
    $venue = htmlspecialchars($_POST['venue'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
    $unique_id = uniqid(); 
    date_default_timezone_get("Africa/Lagos");
    $date = date('Y/m/d h:i:s a', time()); 
    $status = 'pending';

    if(empty($name)) {
        echo "<span>Kindly provide your name.</span>";
    } elseif(empty($email)) {
        echo "<span class=''>Kindly provide your email.</span>";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span class=''>Kindly provide a valid email address.</span>";
    } elseif(empty($event_type)) {
        echo "<span>Kindly select event type.</span>";
    } 
    elseif(empty($event_date)) {
        echo "<span>Kindly provide event date.</span>";
    } 
    elseif(empty($start_time)) {
        echo "<span>Kindly provide event start time.</span>";
    } 
    elseif(empty($end_time)) {
        echo "<span>Kindly provide event end time.</span>";
    } 
    elseif(empty($venue)) {
        echo "<span>Kindly provide eevent venue.</span>";
    } 
  
    else {
        try {
            $sql = "INSERT INTO bookings(booking_id, event_type, name, email, event_date, venue, start_time, end_time, phone, created_date, status, remark) VALUES(:booking_id, :event_type, :name, :email, :event_date, :venue, :start_time, :end_time, :phone, :created_date, :status, :remark)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'booking_id' => $unique_id,
                'event_type' => $event_type,
                'name' => $name,
                'email' => $email,
                'event_date' => $event_date,
                'venue' => $venue,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'phone' => $phone,
                'created_date' => $date,
                'status' => $status,
                'remark' => $message
            ]);

            if($stmt->rowCount() > 0) {
                echo "successful";
            } else {
                echo "error";
            }
        } catch(PDOException $e) {
            // Log or handle the error appropriately
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
