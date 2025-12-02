<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include "../includes/functions.php";
    require_once "../database/config.php";
	if(isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message'])){
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $msg = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
            $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
            $timezone = htmlspecialchars($_POST['ctimezone'], ENT_QUOTES, 'UTF-8');
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
            else if(empty($phone)){
				echo "<span>kindly provide your phone number.</span>";
			}
			else if(empty($msg)){
				echo "<span>kindly leave a message.</span>";
			}		
			else {
                $sql = "INSERT INTO contact(name, email, phone, body, created_date) VALUES(:name, :email, :phone, :body, :created_date)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'body' => $msg,
                'created_date' => $date
                ]);
                if($stmt){
                echo "successful";
                
                // Send mail to user
                $to = $email;
                $subject = "Your message had been received";
                $username = $name;
                $mailHeader = "Thanks for reaching out to us";
                $mailBody = "Thank you for sending a message. Our friendly customer team will be in touch.";
                $mail = sendEmail($to, $subject,  $mailHeader, $mailBody, $username);
                echo $mail;
                
                // Send mail to admin
                $to_admin = '3mal.official@gmail.com';
                $admin_subject = "Webform via 3Mal's website";
                $admin_username = 'Admin';
                $admin_mailHeader = "New contact form submission ";
                $admin_mailBody = "A user with the following details; name: $name, email: $email, phone: <a href='tel:$phone'>$phone</a> just filled a webform. Kindly follow up on this user.";
                $admin_mail = sendEmail($to_admin, $admin_subject, $admin_mailHeader, $admin_mailBody,  $admin_username);
                echo $admin_mail;
                }
                else {
                echo "error";
                } 
}
} 
?>