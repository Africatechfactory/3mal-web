<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "../database/config.php";
    include "../includes/functions.php";
    if(isset($_POST['email'])){    
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
    try {
        date_default_timezone_set($timezone);
    } catch (Exception $e) {
        date_default_timezone_set("UTC");
    }
    $date = date('Y/m/d h:i:s a', time());

    if(empty($email)){
    echo "<span class=''>Kindly provide have your email</span>";
    }
    else if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "<span class=''>Kindly provide a  valid email address</span>";
    }

    else {
        $sql = "INSERT INTO newletter(email, created_date) VALUES(:email, :created_date)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
        'email' => $email,    
        'created_date' => $date
        ]);
        if($stmt){
        echo "successful " . $email;
        
        //Send mail to user
        $to = $email;
        $subject = "Thanks for joining our newsletter";
        $username = '';
        $mailHeader = "Thanks for Signing up on our Newsletter";
        $mailBody = "Thank you for signing up for 3Mal's newsletter. We're thrilled to have you join our community of 10k subscribers.";
        $mail = sendEmail($to, $subject, $mailHeader, $mailBody,  $username);
        echo $mail;
        
        // Send mail to admin
        $to_admin = '3mal.official@gmail.com';
        $admin_subject = "A new user subscribed to our newsletter via 3Mal's website";
        $admin_username = 'Admin';
        $admin_mailHeader = "New subscription to our newsletter";
        $admin_mailBody = "A user with the email: $email just subscribed to our newsletter. Kindly follow up on this user.";
        $admin_mail = sendEmail($to_admin, $admin_subject, $admin_mailHeader, $admin_mailBody,  $admin_username);
        echo $admin_mail;
        }
        else {
        echo "error";
        } 
}
}  else {
    echo "Error posting to DB";
}
?>