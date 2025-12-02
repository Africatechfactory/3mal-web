<?php
   header("Access-Control-Allow-Origin: *"); 
   header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
   header("Access-Control-Allow-Headers: Content-Type, Authorization");
   
       ini_set('display_errors', 1);
       ini_set('display_startup_errors', 1);
       error_reporting(E_ALL);
   include "../database/config.php";
   include "../includes/functions.php";
   if (isset($_POST['reply_name'])) {
       $name = htmlspecialchars($_POST['reply_name'], ENT_QUOTES, 'UTF-8');
       $news_id = htmlspecialchars($_POST['news_id'], ENT_QUOTES, 'UTF-8');
       $reply_to = htmlspecialchars($_POST['reply_to'], ENT_QUOTES, 'UTF-8');
       $response = $_POST['text'];
       $url = $_POST['url'];
       $comment_id = htmlspecialchars($_POST['comment_id'], ENT_QUOTES, 'UTF-8');
       $email = htmlspecialchars($_POST['reply_email'], ENT_QUOTES, 'UTF-8');
        $user_email = htmlspecialchars($_POST['user_email'], ENT_QUOTES, 'UTF-8');
        $user_name = htmlspecialchars($_POST['user_name'], ENT_QUOTES, 'UTF-8');
       $reply_id = uniqid();
        $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
       try {
           date_default_timezone_set($timezone);
       } catch (Exception $e) {
           date_default_timezone_set("UTC");
       }
       $date = date('Y/m/d h:i:s a', time());
   
       if (empty($name)) {
           echo "<span>kindly provide your name.</span>";
       } elseif (empty($response)) {
           echo "<span>kindly provide a response.</span>";
       } elseif ($email === false) {
           echo "<span>kindly provide a valid email address.</span>";
       } else {
           try {
               $sql = "INSERT INTO reply (reply_id, comment_id, news_id, name, email, sender_email, reply_to, text, date) VALUES (:reply_id, :comment_id, :news_id, :name, :email, :sender_email, :reply_to, :text, :date)";
               $stmt = $pdo->prepare($sql);
               $stmt->execute([
                   'reply_id' => $reply_id,
                   'comment_id' => $comment_id,
                   'news_id' => $news_id,
                   'name' => $name,
                   'email' => $email,
                    'sender_email' => $user_email,
                   'reply_to' => $reply_to,
                   'text' => $response,
                   'date' => $date
               ]);
   
               if ($stmt) {
                   echo "successful";
                     // Send mail to user
                     $to = $user_email;
                     $subject = "New Comment Reply on 3mal's Website";
                     $username = $reply_to;
                     $mailHeader = "Comment reply from 3mal's Website";
                     $mailBody = "$name has just responded to your comment on 3mal's website. <p> Click the <a href='$url'>link</a> to view the post and see the reply.</p>";
                     $mail = sendEmail($to, $subject,  $mailHeader, $mailBody, $username);
                     echo $mail;
                     
                    //  // Send mail to admin
                    //  $to_admin = 'crahvik@gmail.com';
                    //  $admin_subject = "Webform via 3mal's website";
                    //  $admin_username = 'Admin';
                    //  $admin_mailHeader = "New contact form submission ";
                    //  $admin_mailBody = "A user with the following details; name: $name, email: $email, phone: <a href='tel:$phone'>$phone</a> just filled a webform. Kindly follow up on this user.";
                    //  $admin_mail = sendEmail($to_admin, $admin_subject, $admin_mailHeader, $admin_mailBody,  $admin_username);
                    //  echo $admin_mail;
               } else {
                   echo "error";
               }
           } catch (PDOException $e) {
               echo "Database error: " . $e->getMessage();
           }
       }
   } 
   ?>