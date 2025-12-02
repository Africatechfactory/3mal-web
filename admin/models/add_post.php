<?php
   header("Access-Control-Allow-Origin: *"); 
   header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
   header("Access-Control-Allow-Headers: Content-Type, Authorization");
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
    include "../../includes/session.php";
    include "../../database/config.php";
    include "../../includes/functions.php";

if(isset($_POST['title'])) {
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $post =$_POST['post'];
    $author = htmlspecialchars($_POST['author'], ENT_QUOTES, 'UTF-8');
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
    $keywords = htmlspecialchars($_POST['keywords'], ENT_QUOTES, 'UTF-8');
    $img_caption = htmlspecialchars($_POST['image_caption'], ENT_QUOTES, 'UTF-8');
    $data_id  = uniqid();
    $timezone = htmlspecialchars($_POST['timezone'], ENT_QUOTES, 'UTF-8');
    $update_date = '';
    $views = 0;
    try {
        date_default_timezone_set($timezone);
    } catch (Exception $e) {
        date_default_timezone_set("UTC");
    }
    $date = date('Y/m/d h:i:s a', time());
    if(empty($title)) {
        echo "<span>Kindly provide news headline/title</span>";
        exit();
    } elseif(empty($author)) {
        echo "<span>Kindly provide news author</span>";
        exit();
    } elseif(empty($category)) {
        echo "<span>Kindly provide news category</span>";
        exit();
    } elseif(empty($keywords)) {
        echo "<span>Kindly type at least one keyword</span>";
        exit();
    } elseif(empty($post)) {
        echo "Post body can't be empty";
        exit();
    } else {
        $upload_dir = "../../images/story/";
        $img_url = "/images/story/";
              $file_path = $url . $img_url;
        $uploadMultipleImagesResult = uploadMultipleImages($pdo, $data_id, $upload_dir, $file_path, $date);
        if ($uploadMultipleImagesResult === "All images uploaded successfully.") {
             $status = "published";
                    $explode_title = str_replace(" ", "-", $title);
                    $story_url = $url . "/article/" . $data_id . "_" . $explode_title;

                    $query_sql = "INSERT INTO blog(title, body, blog_id, image_caption, author, category, keywords, story_url, status, created_date, update_date, views) VALUES(:title, :body, :blog_id,  :image_caption, :author, :category, :keywords, :story_url, :status, :created_date, :update_date, :views)";
                    $query_stmt = $pdo->prepare($query_sql);
                    $query_stmt->execute([
                        'title' => $title,
                        'body' => $post,
                        'blog_id' => $data_id,
                        'image_caption' => $img_caption,
                        'author' => $author,
                        'category' => $category,
                        'keywords' => $keywords,
                        'story_url' => $story_url,
                        'status' => $status,
                        'created_date' => $date,
                        'update_date' => $update_date,
                        'views' => $views,
                    ]);

                    if ($query_stmt) {
                        echo 'successful';
                    } else {
                        echo 'error';
                    }
        }
        else {
            echo "Error uploading images";
        }
      
    }
}
?>
