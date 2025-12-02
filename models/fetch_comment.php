<?php
   header("Access-Control-Allow-Origin: *"); 
   header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
   header("Access-Control-Allow-Headers: Content-Type, Authorization");
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
   include "../database/config.php";
   
   if (isset($_GET['news_id'])) {
       $news_id = $_GET['news_id'];
       try {
           $fetchdata = "SELECT * FROM comments WHERE news_id = :news_id ORDER BY id DESC";
           $stmt = $pdo->prepare($fetchdata);
           $stmt->execute(['news_id' => $news_id]);
           
           if ($stmt->rowCount() > 0) {
               while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                    $user_email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
                   $text = $row['text'];
                   $date = $row['date'];
                   $date_obj = date_create($date);
                   $date_posted = date_format($date_obj, "d M, Y");
                   $id = $row['id'];
                   $comment_id = $row['comment_id'];
   ?>
<div class="row">
   <div class="col-sm-12">
      <div class="item_response">
         <h2><?= $name ?></h2>
         <span><?= $date_posted; ?></span>
         <div class="para">
            <?= $text ?>
         </div>
         <div class="row">
            <div class="col-sm-6 col-6">
               <div class="reply_btn">
                  <?php
                     $sql_top = "SELECT * FROM reply WHERE comment_id = :comment_id";
                     $stmt_top = $pdo->prepare($sql_top);
                     $stmt_top->execute(['comment_id' => $comment_id]);
                     if ($stmt_top->rowCount() > 0) {
                         echo "<p class='rep_btn fetch_reply' target='$comment_id'>View Replies <i class='bi bi-chevron-double-right'></i></p>";
                     } else {
                         echo "";
                     }
                     ?>
               </div>
            </div>
            <div class="col-sm-6 col-6">
               <div class="reply_btn text-right">
                  <p class="rep_btn reply_action_btn" target="<?= $id; ?>">Reply <i class='bi bi-chevron-double-right'></i></p>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="show_user_reply_<?= $comment_id; ?> show_reply_toggle">
               </div>
            </div>
         </div>
         <div class="reply_panel reply_pane_<?= $id; ?>">
            <form action="" class="reply_form_<?=  $id; ?>" method="post">
               <div class="form-group col-sm-12 pl-0 pr-0">
                  <label for="">Your Name</label>
                  <input type="text" placeholder="E.g. John Doe" name="reply_name" class="form-control raw_input">
               </div>
               <div class="form-group col-sm-12 pl-0 pr-0">
                  <label for="">Your Email</label>
                  <input type="email" placeholder="E.g. johndoe@mymail.com" name="reply_email" class="form-control raw_input">
                  <input type="hidden" name="timezone" id="replyTimezone" />
               </div>
               <div class="form-group col-sm-12 pl-0 pr-0 mb-0">
                  <input type="text" value="<?=  $news_id ?>" hidden name="news_id" class="form-control raw_input">
                    <input type="text"  hidden name="url" class="form-control raw_input" id="data_url">
               </div>
               <div class="form-group col-sm-12 pl-0 pr-0 mb-0">
                  <input type="text" value="<?=  $comment_id ?>" hidden name="comment_id" class="form-control raw_input">
               </div>
               <div class="form-group col-sm-12 pl-0 pr-0 mb-0">
                  <input type="text" value="<?=  $name ?>" hidden name="reply_to" class="form-control raw_input">
               </div>
               <div class="form-group col-sm-12 pl-0 pr-0">
                  <label for="">Replying to <?= $name; ?></label>
                    <input type="text" value="<?= $user_email ?>" hidden name="user_email"  class="form-control raw_input">
                    <input type="text" value="<?= $name ?>" hidden name="user_name"  class="form-control raw_input">
                  <textarea name="text" id="" class="form-control reply_input raw_input" rows="2"></textarea>
               </div>
               <div class="form-group col-sm-12 pl-0 pr-0 text-right">
                  <button type="submit" name="submit" class="form-control btn repond_active post_reply">Reply</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php
   }
   } else {
   echo "
    <p class='no_comment'>Be the first to leave a comment.</p>
   <img src='https://img.freepik.com/premium-photo/3d-rendering-3d-illustration-chat-bubble-icon-isolated-white-background-minimal-purple-blue-chat-typing-design-element-social-media-messages-comment_640106-152.jpg' class='img-fluid' alt='Leave a comment' >
   ";
   }
   } catch (PDOException $e) {
   echo "Error: " . $e->getMessage();
   }
   }
   ?>