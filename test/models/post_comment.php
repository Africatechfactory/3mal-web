<?php
   include "../database/config.php";
   include "../includes/functions.php";
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
       $url=$_POST['news_url'];
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
                   echo "successful ". $news_id;
                     // Send mail to user
                     $to = $email;
                     $subject = "Your comment has been received";
                     $username = $name;
                     $mailHeader = "Thank You for Your Comment! 😊";
                     $mailBody = "Thank you so much for taking the time to leave a comment on our blog! We genuinely appreciate your thoughts and feedback.
                    <p>Our team loves engaging with our readers and your input helps us improve and grow. If there's anything specific you'd like to see more of, please don't hesitate to let us know.</p>
                    <p>Stay tuned for more exciting content and updates. We look forward to hearing more from you!</p>";
                     $mail = sendEmail($to, $subject,  $mailHeader, $mailBody, $username);
                     echo $mail;
                     
                     // Send mail to admin
                     $to_admin = 'admin@3malgroup.com';
                     $admin_subject = "Comments via 3mal's website";
                     $admin_username = 'Admin';
                     $admin_mailHeader = "New comment from the website.";
                     $admin_mailBody = "A user with the following details: Name: $name, Email: $email, just posted a comment on the website. Kindly click the <a href='$url'>link</a> to reply to the comment.";
                     $admin_mail = sendEmail($to_admin, $admin_subject, $admin_mailHeader, $admin_mailBody,  $admin_username);
                     echo $admin_mail;
               } else {
                   echo "error";
               }
           } catch(PDOException $e) {
               echo "Error: " . $e->getMessage();
           }
       }
   }
   ?>