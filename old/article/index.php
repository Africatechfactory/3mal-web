<?php
   include "../components/header.php";
   require_once "../database/config.php";
   require_once "../includes/functions.php";
   $url=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   try {
       if (isset($_GET['page'])) {
           $page = $_GET['page'];
           $page = explode("_", $page);
           $blog_id = $page[0];
           $query = "SELECT *
                     FROM blog b
                     INNER JOIN images i ON b.blog_id = i.data_id
                     WHERE b.blog_id = ?";
           $stmt = $pdo->prepare($query);
           $stmt->execute([$blog_id]);
           if ($stmt->rowCount() == 1) {
               $data = $stmt->fetch(PDO::FETCH_ASSOC);
               $article_top = substr(reverse_secure_input($data['body']), 0, 100) . "...";
               $image = $data['image_url'];
               $title_top = $data['title'];
               $author = $data['author'];
               $created_date = $data['created_date'];
               $updated_date = $data['update_date'];
           } else {
              // echo "BLog ID: " . $title_top;
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
<meta property="og:title" content="<?php echo reverse_secure_input($title_top); ?>" />
<link rel="icon" type="image/x-icon" href="#">
<meta property="og:url" content="<?php echo $url; ?>" />
<meta property="og:image" content="<?php echo $image; ?>" />
<meta property="og:description" content="<?php  echo reverse_secure_input($article_top); ?>" />
<meta property="og:site_name" content="3Mal Group" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo reverse_secure_input($title_top); ?> - 3Mal Group</title>
<link rel="canonical" href="<?php echo $url; ?>" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="article:published_time" content="<?php echo $created_date; ?>" />
<meta property="article:modified_time" content="<?php echo $updated_date; ?>" />
<meta property="og:image:width" content="512" />
<meta property="og:image:height" content="512" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="author" content="<?php echo $author ?>" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:label1" content="Written by" />
<meta name="twitter:data1" content="<?php echo $author ?>" />
<meta name="twitter:label2" content="Est. reading time" />
<meta name="twitter:data2" content="5 minutes" />
</head>
<body>
   <p hidden class="get_news_id"><?= $blog_id; ?></p>
   <!--Navigation-->
   <?php  include "../components/navbar.php" ?>
   <?php  include "../components/right_comment_box.php" ?>
   <?php
      try {
         if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $page = explode("_", $page);
            $blog_id = $page[0];
            
            $query = "SELECT b.blog_id, b.title, b.created_date, b.author, b.body, b.category, b.keywords, i.image_url
            FROM blog b
            INNER JOIN images i ON b.blog_id = i.data_id
            WHERE b.blog_id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$blog_id]);
      
            if ($stmt->rowCount() == 1) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $author = reverse_secure_input($data['author']);
                $article = reverse_secure_input($data['body']);
                $category = reverse_secure_input($data['category']);
                $keyword = reverse_secure_input($data['keywords']);
                $dateposted = $data['created_date'];
                $date_obj = date_create($dateposted);
                $date_posted = DATE_FORMAT($date_obj, "d M, Y");
                $title = reverse_secure_input($data['title']);
      
                $views = blog_view_count($blog_id, $pdo);
                $view_word = ($views == 1) ? ' view' : ' views';
      ?>
   <!--Page Header-->
   <div class="container-fluid page_header">
      <div class="row">
         <div class="col-md-1 col-lg-2 col-xl-2"></div>
         <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8 col-12">
            <div class="breadcrumbs">
               <a href="../">Home Page</a> <span>/</span> <a href="../blog">Blog</a> <span>/</span> <a class="inactive"><?= $title ?></a>
            </div>
         </div>
         <div class="col-md-1 col-lg-2 col-xl-2"></div>
      </div>
   </div>
   <div class="comment_btn">
      <p class="comment_btn" target="<?= $blog_id; ?>">Comment <span class="body_row_count"></span></p>
   </div>
   <div class="container-fluid article_body">
      <div class="row">
         <div class="col-md-1 col-lg-2 col-xl-2"></div>
         <div class="col-sm-12 col-md-10 col-lg-8 col-xl-8 col-12">
            <div class="row">
             
               <div class="col-sm-12 col-12 col-md-12 col-xl-12 col-lg-12">
                  <div class="item_box">
                     <div class="header">
                        <h1><?= $title; ?></h1>
                        <div class="d-flex">
                           <span class="date">Date: <b><?=  $date_posted; ?></b></span>
                           <span class="author">Author: <b><?=  $author; ?></b></span>
                           <span class="category">Category: <b> <?=  $category; ?></b></span>
                        </div>
                     </div>
                     <div class="img_box">
                        <img src="<?=  $image; ?>" alt="<?=  $title; ?>" class="img-fluid">
                     </div>
                     <div class="text_box">
                        <p><?= $article; ?></p>
                     </div>
                     <div class="text_box">
                         
                        <div class="dropdown-divider mb-3"></div>
                        
                        <div class="d-flex">
                            <h4><?= $views.$view_word; ?></h4>
                        <div class="share_socials">
                     <!-- <p>Share</p> -->
                     <div class="socials">
                        <!-- <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $url; ?>" target="_blank"><i class="bi bi-linkedin"></i></a> -->
                        <a class="copy_to_clipboard"><i class="bi bi-copy"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url; ?>" title="Share on Facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.twitter.com/intent/tweet?text=<?= $title; ?>&url=<?=  $url;?>" title="Share on Twitter" target="_blank"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://wa.me/?text=<?=  $url; ?>" title="Share on WhatsApp" target="_blank"><i class="bi bi-whatsapp"></i></a>     
                     </div>
                  </div>
                        </div>
                        <div class="dropdown-divider mt-3"></div>
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
 <script>
         $(function () {
  
    function countComments(){
         var fetch_news_id = $(".get_news_id").text();
         $.ajax({
      url: "https://3malgroup.com/models/count_rows.php",
      method: "POST",
      data: {
         news_id: fetch_news_id
      },
      dataType: "html",
      success: function (data) {
         $(".body_row_count").html(data);
      }
   });
    }
   
     $('.copy_to_clipboard').click(function(){
                var url = window.location.href;
                var $tempInput = $('<input>');
                $('body').append($tempInput);
                $tempInput.val(url).select();
                document.execCommand('copy');
                $tempInput.remove();
                $(".alert p").html('Link copied to clipboard.');
                $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
            });
            
            
              $(document).on('click', '.post_response', function () {
        $('.response_form').unbind('submit');
        var loader = '<span class="loader"></span>';
        var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        $('#commentTimezone').val(timezone);
        $('.response_form').submit(function (event) {
           event.preventDefault();
           $.ajax({
              url: "https://3malgroup.com/models/post_comment.php",
              method: "POST",
              data: new FormData(this),
              contentType: false,
              processData: false,
              beforeSend: function () {
               $('.post_response').html(loader);
              },
              complete: function () {
                 $('.post_response').html("Comment");
              },
              success: function (data) {
                 var message = $.trim(data);
                var myArray = message.split(" ");
                var success = myArray[0];
                let news_id = myArray[1];
                 if (success == "successful") {
                    $(".alert p").html("Comment sent successfully");
                    $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                    fetchComments(news_id);
                    countComments();
                    $(".raw_input").val(null);
                    $(".ck-content").empty();
                    // $(".right_action_box").removeClass('active');
                    // $(".fixed_bg").fadeOut(1000);
                 } else {
                    $(".alert p").html(message);
                    $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
                 }
              }
           });
        });
     });

 
    
     function fetchComments(news_id) {
            $(".right_action_box").addClass("active");
            var loader = '<span class="loader"></span>';
            $(".fixed_bg").fadeIn(1000);
            var pageURL = window.location.href;
            $("#url").attr("value", pageURL);
            $("#news_id").attr("value", news_id);

            $.ajax({
                url: "https://3malgroup.com/models/fetch_comment.php",
                method: "GET",
                data: {
                    news_id: news_id
                },
                dataType: "html",
                beforeSend: function () {
                    $(".response_box").html("<p class='no_comment'>Fetching comments...</p>");
                },
                success: function (data) {
                    $(".response_box").html(data);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching comments: ", status, error);
                    $(".response_box").html("<p>Error loading comments. Please try again.</p>");
                }
            });
        }
    
     $(document).on('click', '#comment_btn', function () {
            var news_id = $(this).attr("target");
            fetchComments(news_id);
        });


   $(document).on('click', `.reply_action_btn`, function () {
      var comment_id = $(this).attr("target");
      var reply_panel = $(`.reply_panel.reply_pane_${comment_id}`);

      // Toggle the reply panel
      reply_panel.toggleClass("reply_panel_active");

      // Check if the editor is already initialized
      if (!reply_panel.data('editorInitialized')) {
         ClassicEditor
            .create(document.querySelector(`.reply_form_${comment_id} .reply_input`))
            .then(editor => {
               reply_panel.data('editor', editor);
            })
            .catch(error => {
               console.error(error);
            });

         // Mark this panel as having the editor initialized
         reply_panel.data('editorInitialized', true);
      }

      $(document).on('click', `.reply_form_${comment_id} .post_reply`, function (event) {
         $(`.reply_form_${comment_id}`).unbind('submit');
         var loader = '<span class="loader"></span>';
         var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
         $(`.reply_form_${comment_id} #replyTimezone`).val(timezone);

         $(`.reply_form_${comment_id}`).submit(function (event) {
            $.ajax({
               url: "https://3malgroup.com/models/post_reply.php",
               type: "POST",
               data: new FormData(this),
               cache: false,
               contentType: false,
               processData: false,
               beforeSend: function () {
                  $(`.reply_form_${comment_id} .post_reply`).html(loader);
               },
               complete: function () {
                  $(`.reply_form_${comment_id} .post_reply`).html("Reply");
               },
               success: function (data) {
                  var message = $.trim(data);
                  if (message === 'successful') {
                     $(`.reply_pane_${comment_id}`).removeClass("reply_panel_active");
                     $(".alert p").html('Response sent successfully');
                     $(".alert").attr("class", "alert alert-success").fadeIn().delay(5000).fadeOut();
                     $(`.reply_form_${comment_id} .raw_input`).val(null);
                     fetchReplies(comment_id);
                  } else {
                     $(".alert p").html(message);
                     $(".alert").attr("class", "alert alert-danger").fadeIn().delay(5000).fadeOut();
                  }
               }
            });
            event.preventDefault();
         });
      });
   });


   function fetchReplies(get_comment_id) {
            var loader = '<span class="loader"></span>';
            $.ajax({
                url: "https://3malgroup.com/models/fetch_reply.php",
                method: "GET",
                data: {
                    get_comment_id: get_comment_id
                },
                dataType: "html",
                beforeSend: function () {
                   // $(`.show_user_reply_${get_comment_id}`).html("<p class='no_comment'>Fetching replies...</p>");
                },
                success: function (data) {
                    $(`.show_user_reply_${get_comment_id}`).html(data);
                    $(`.show_user_reply_${get_comment_id}`).toggleClass('show_reply_toggle');
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching replies: ", status, error);
                    $(`.show_user_reply_${get_comment_id}`).html("<p>Error loading replies. Please try again.</p>");
                }
            });
        }

        $(document).on('click', '.fetch_reply', function () {
            var get_comment_id = $(this).attr("target");
            fetchReplies(get_comment_id);
        });

   $(".close_btn").click(function () {
      $(".right_action_box").removeClass("active");
      $(".fixed_bg").fadeOut(1000);
   })
   $(".fixed_bg").click(function () {
      $(".right_action_box").removeClass("active");
      $(".fixed_bg").fadeOut(1000);
   });

   ClassicEditor
      .create(document.querySelector('.comment_box'))
      .catch(error => {
         console.error(error);
      });
      
   // fetchComments();
    countComments();
});
      </script>