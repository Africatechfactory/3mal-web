<?php
   header("Access-Control-Allow-Origin: *"); 
   header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
   header("Access-Control-Allow-Headers: Content-Type, Authorization");
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
require_once "../database/config.php";
include "../includes/functions.php";
	if(isset($_POST['name'])){
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $msg = htmlspecialchars($_POST['msg'], ENT_QUOTES, 'UTF-8');
            $budget = htmlspecialchars($_POST['budget'], ENT_QUOTES, 'UTF-8');
            $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
            $interests = isset($_POST['user_interest']) ? $_POST['user_interest'] : '';
            $interests_json = json_encode($interests);
            try {
                date_default_timezone_set($timezone);
            } catch (Exception $e) {
                date_default_timezone_set("UTC");
            }
            $date = date('Y/m/d h:i:s a', time()); 
			if(empty($name)){
				echo "<span>kindly provide your name.</span>";
			} 
            else if(empty($email)){
            echo "<span class=''>Kindly provide have your email</span>";
            }
            else if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<span class=''>Kindly provide a  valid email address</span>";
            }
            else if(empty($budget)){
				echo "<span>kindly select a budget</span>";
			}
				
			else {
                $sql = "INSERT INTO reach_us(name, email, message, user_interest, budget, created_date) VALUES(:name, :email, :message, :user_interest, :budget, :created_date)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                'name' => $name,
                'email' => $email,
                'message' => $msg,
                'user_interest' => $interests_json,
                 'budget' => $budget,
                'created_date' => $date
                ]);
                if($stmt){
                echo "successful";
                  //Send mail to user
        $to = $email;
        $subject = "Enquiry";
        $username = '';
        $mailHeader = "Thanks for reaching us";
        $mailBody = "Thank you for reaching us, our customer care agent will call you shortly.";
        $mail = sendEmail($to, $subject, $mailHeader, $mailBody,  $username);
        echo $mail;
        
        // Send mail to admin
        $to_admin = '3mal.official@gmail.com';
        $admin_subject = "A user made an enquiry about our services via 3Mal's website";
        $admin_username = 'Admin';
        $admin_mailHeader = "New service request";
        $admin_mailBody = "A user with the email: $email just made an enquiry of our services. Kindly follow up on this user.";
        $admin_mail = sendEmail($to_admin, $admin_subject, $admin_mailHeader, $admin_mailBody,  $admin_username);
        echo $admin_mail;
                }
                else {
                echo "error";
                } 
}
} 
?>