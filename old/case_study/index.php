<!DOCTYPE html>
<html lang="en">
   <head>
      <?php 
         error_reporting(E_ALL);
         ini_set('display_errors', 1);
           include "../components/header.php";
           require_once "../database/config.php";
           require_once "../includes/functions.php";
           $url=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
           try {
               if (isset($_GET['page'])) {
                   $page = $_GET['page'];
                   $page = explode("_", $page);
                   $data_id = $page[0];
                   $query = "
                   SELECT c.data_id, c.title, c.body, c.created_date, c.update_date, MAX(i.image_url) AS image_url
                   FROM case_study c
                   INNER JOIN images i ON c.data_id = i.data_id
                   WHERE c.data_id = ?
                   GROUP BY c.data_id, c.title, c.body, c.created_date, c.update_date
                   ";
               $stmt = $pdo->prepare($query);
                   $stmt->execute([$data_id]);
                   if ($stmt->rowCount() == 1) {
                       $data = $stmt->fetch(PDO::FETCH_ASSOC);
                       $article_top = substr(reverse_secure_input($data['body']), 0, 100) . "...";
                       $image = $data['image_url'];
                       $title_top = $data['title'];
                       $created_date = $data['created_date'];
                       $updated_date = $data['update_date'];
                   } else {
                       header("Location: ../404/");
                       exit;
                   }
               } else {
                   http_response_code(400);
                   echo json_encode(['error' => 'Invalid request']);
                   exit;
               }
           } catch (PDOException $e) {
               http_response_code(500);
               echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
               exit; 
           }
           ?>
      <meta charset="UTF-8">
      <meta property="og:title" content="<?php echo reverse_secure_input($title_top); ?>" />
      <link rel="icon" type="image/x-icon" href="https://3malgroup.com/images/logo.png">
      <meta property="og:url" content="<?php echo $url; ?>" />
      <meta property="og:image" content="<?php echo $image; ?>" />
      <meta property="og:description" content="<?php  echo reverse_secure_input($article_top); ?>" />
      <meta property="og:site_name" content="3MAL Group" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo reverse_secure_input($title_top); ?> - 3MAL Group</title>
        <link rel="canonical" href="<?php echo $url; ?>" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="article:published_time" content="<?php echo $created_date; ?>" />
        <meta property="article:modified_time" content="<?php echo $updated_date; ?>" />
        <meta property="og:image:width" content="512" />
        <meta property="og:image:height" content="512" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:label2" content="Est. reading time" />
        <meta name="twitter:data2" content="5 minutes" />


   </head>
   <body>
      <!--Navigation-->
      <?php include "../components/navbar.php" ?>
      <?php
         try {
            if (isset($_GET['page'])) {
               $page = $_GET['page'];
               $page = explode("_", $page);
               $data_id = $page[0];
               
               $query = "SELECT * FROM case_study WHERE data_id = ?";
               $stmt = $pdo->prepare($query);
               $stmt->execute([$data_id]);
               if ($stmt->rowCount() == 1) {
                  $data = $stmt->fetch(PDO::FETCH_ASSOC);
                  $status = reverse_secure_input($data['status']);
                  $article = reverse_secure_input($data['body']);
                  $tag = reverse_secure_input($data['tag']);
                  $client = reverse_secure_input($data['client']);
                //   $dateposted = $data['event_date'];
                //   $date_obj = date_create($dateposted);
                //   $date_posted = DATE_FORMAT($date_obj, "d M, Y");
                  $title = reverse_secure_input($data['title']); 
                  $get_data_id = $data['data_id'];  
                     ?>
      <!--Page Header-->
      <div class="container-fluid page_header data-case-study">
         <div class="row">
            <div class="col-md-1 col-lg-2 col-xl-2"></div>
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8 col-12">
               <div class="breadcrumbs">
                  <a href="../">Home Page</a> <span>/</span> <a href="../case-study/">Cae study</a> <span>/</span> <a class="inactive"><?= $title ?></a>
               </div>
            </div>
            <div class="col-md-1 col-lg-1 col-xl-1"></div>
         </div>
      </div>
      <div class="container-fluid article_body data-case-study">
         <div class="row">
            <div class="col-md-1 col-lg-2 col-xl-2"></div>
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8 col-12">
               <div class="row">
                  <div class="col-sm-12 col-12 col-md-12 col-xl-12 col-lg-12">
                     <div class="item_box">
                        <div class="header">
                           <h1><?= $title; ?></h1>
                           <div class="d-flex">
                              <span class="author">Client: <b><?=  $client; ?></b></span>
                              <span class="category">Status: <b> <?=  $status; ?></b></span>
                              <span class="date">Tag: <b><?=  $tag; ?></b></span>
                           </div>
                        </div>
                        <div class="row">
                           <?php
                              $imageQuery = "SELECT * FROM images WHERE data_id = ?";
                              $imageResult = $pdo->prepare($imageQuery);
                              $imageResult->execute([$get_data_id]); 
                              
                              if ($imageResult->rowCount() > 0) { 
                              while ($row = $imageResult->fetch(PDO::FETCH_ASSOC)) {
                              $image_url = $row['image_url'];
                              ?>
                           <div class="col-sm-6">
                              <div class="event_img_box">
                                 <img class="img-fluid" alt="<?= $title; ?>" src="<?= $image_url; ?>" />
                              </div>
                           </div>
                           <?php
                              }
                              } else {
                              echo json_encode(['error' => 'No Image(s) found for this event']);
                              }
                              ?>
                        </div>
                        <div class="text_box">
                           <p><?= $article; ?></p>
                        </div>
                        <div class="text_box">
                           <div class="dropdown-divider mb-4"></div>
                           <div class="d-flex">
                              <div class="share_socials">
                                 <!-- <p>Share</p> -->
                                 <div class="socials">
                                    <!-- <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $url; ?>" target="_blank"><i class="bi bi-linkedin"></i></a> -->
                                    <!--<a href="https://www.linkedin.com/shareArticle?mini=true&?url=<?= $url; ?>&title=<?= $title; ?>" target="_blank"><i class="bi bi-linkedin"></i></a>-->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url; ?>" title="Share on Facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                                    <a href="https://www.twitter.com/intent/tweet?text=<?= $title; ?>&url=<?=  $url;?>" title="Share on Twitter" target="_blank"><i class="bi bi-twitter-x"></i></a>
                                    <a href="https://wa.me/?text=<?=  $url; ?>" title="Share on WhatsApp" target="_blank"><i class="bi bi-whatsapp"></i></a>     
                                 </div>
                              </div>
                           </div>
                           <div class="dropdown-divider mt-4"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-1 col-lg-2 col-xl-2"></div>
         </div>
      </div>
      <?php
         } 
         } else {
         http_response_code(400);
         echo json_encode(['error' => 'Invalid request']);
         exit;
         }
         }  catch (PDOException $e) {
         http_response_code(500);
         echo json_encode(['error' => 'Body Database error: ' . $e->getMessage()]);
         exit; 
         }
         ?>
      <!--Footer-->
      <?php include "../components/footer.php" ?>